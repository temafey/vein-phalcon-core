<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Container\Form;

use Vein\Core\Crud\Container\Mysql as Container,
    Vein\Core\Crud\Container\Form\Adapter as FormContainer,
    Vein\Core\Crud\Form,
    Vein\Core\Crud\Form\Field,
    Vein\Core\Mvc\Model,
    Vein\Core\Crud\Container\Form\Exception;

/**
 * Class container for MySql.
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Container
 */
class Mysql extends Container implements FormContainer
{
    /**
	 * Form object
	 * @var \Vein\Core\Crud\Form
	 */
	protected $_form;

    /**
     * @var array
     */
    protected $_fields = [];
	
	/**
     * Constructor
     *
     * @param mixed $options
     * @return void
     */
	public function __construct(Form $form, $options = [])
	{
		$this->_form = $form;
		if (!is_array($options)) {
            $optionss = [self::MODEL => $options];
        }
		$this->setOptions($options);
	}

    /**
     * Initialize container model
     *
     * @param string $model
     * @throws \Vein\Core\Exception
     * @return \Vein\Core\Crud\Container\Mysql
     */
    public function setModel($model = null)
    {
        parent::setModel($model);
        $this->_fields[get_class($this->_model)] = $this->_model->getAttributes();

        return $this;
    }

    /**
     * Set join models
     *
     * @param array|string $models
     * @return \Vein\Core\Crud\Container\Form\Mysql
     */
    public function setJoinModels($models)
    {
        parent::setJoinModels($models);
        foreach ($this->_joins as $key => $model) {
            $this->_fields[$key] = $model->getAttributes();
        }

        return $this;
    }

    /**
     * Add join model
     *
     * @param string $model
     * @throws \Exception
     * @return \Vein\Core\Crud\Container\Form\Mysql
     */
    public function addJoin($model)
    {
        $key = parent::addJoin($model);
        if ($key) {
            $this->_fields[$key] = $this->_joins[$key]->getAttributes();
        }

        return $key;
    }

    /**
     * @param $model
     */
    public function initialaizeModels()
    {
        $fields = $this->_form->getFields();
        $notRequeired = [];
        foreach ($fields as $field) {
            if ($field instanceof Field\ManyToMany || $field instanceof Field\Primary || $field instanceof Field\PasswordConfirm) {
                continue;
            }
            $value = $field->getValue();
            if ($value !== null && $value !== '') {
                continue;
            }
            if ($field instanceof Field) {
                $fieldName = $field->getName();
                if (!$field->isRequire()) {
                    $notRequeired[] = $fieldName;
                }
            }
        }

        /*$this->_model->_skipAttributes(array_intersect($this->_fields[get_class($this->_model)], $notRequeired));
        foreach ($this->_joins as $key => $model) {
            $model->_skipAttributes(array_intersect($this->_fields[$key], $notRequeired));
        }*/
    }

    /**
     * Set datasource
     *
     * @return void
     */
    protected function _setDataSource()
    {
        $this->_dataSource = $this->_model->queryBuilder();

        foreach ($this->_joins as $table) {
            $this->_dataSource->columnsJoinOne($table);
        }
        $this->_dataSource->columns($this->_columns);

        foreach ($this->_conditions as $cond) {
            if (is_array($cond)) {
                $this->_dataSource->addWhere($cond['cond'], $cond['params']);
            } else {
                $this->_dataSource->addWhere($cond);
            }
        }
    }

	/**
	 * Return data array
	 * 
	 * @param int $id
	 * @return array
	 */
    public function loadData($id)
    {
        $dataSource = $this->getDataSource();
        $primary = $this->_model->getPrimary();
        $alias = $dataSource->getCorrelationName($primary);
        $dataSource->where($alias.".".$primary." = :id:", ['id' => $id]);
        $result = $dataSource->getQuery()->execute()->toArray();

        return ($result ? $result[0] : false);
    }
	
	/**
	 * Insert new item
	 * 
	 * @param array $data
	 * @return array|integer
	 */
	public function insert(array $data)
	{
		$db = $this->_model->getWriteConnection();
		$db->begin();
        $result = false;
		try {
            $primary = $this->_model->getPrimary();
            $record = clone($this->_model);
			if ($record->create($data)) {
                $id = $record->{$primary};
                $joinResult = $this->_insertToJoins($id, $data);
                $result = $id;
            } else {
                $messages = [];
                foreach ($record->getMessages() as $message) {
                    /*$result = [];
                    $result[] = "Message: ".$message->getMessage();
                    $result[] = "Field: ".$message->getField();
                    $result[] = "Type: ".$message->getType();
                    $messages[] = implode (", ", $result);*/
                    $messages[] = $message->getMessage();
                }
                throw new Exception(implode(', ', $messages));
            }
		} catch (\Vein\Core\Exception $e) {
            $db->rollBack();
            throw $e;
		}
        $db->commit();

		return $result;
	}
	
	/**
	 * Insert new data to joins by reference id
	 * 
	 * @param string $id
	 * @param array $data
	 * @return array
	 */
	protected function _insertToJoins($id, $data)
	{
        $result = [];
	    foreach ($this->_joins as $model) {
	        $referenceColumn = $model->getReferenceColumn($this->_model);
	        $data[$referenceColumn] = $id;
            $record = clone($model);
            if ($record->create($data)) {
                $primary = $record->getPrimary();
                $result[] = $record->{$primary};
            } else {
                $messages = [];
                foreach ($record->getMessages() as $message) {
                    /*$result = [];
                    $result[] = "Message: ".$message->getMessage();
                    $result[] = "Field: ".$message->getField();
                    $result[] = "Type: ".$message->getType();
                    $messages[] = implode (", ", $result);*/
                    $messages[] = $message->getMessage();
                }
                throw new Exception(implode(', ', $messages));
            }
	    }
	    
	    return $result;
	}

    /**
     * Update rows by primary id values
     *
     * @param array $id
     * @param array $data
     * @return bool|array
     */
    public function update($id, array $data)
    {
        $db = $this->_model->getWriteConnection();
        $db->begin();
        try {
            $primary = $this->_model->getPrimary();
            unset($data[$primary]);
            $record = $this->_model->findFirst($id);
            if (!$record) {
                throw new Exception("Record by primary key '".$primary."' and value '".$id."' not found!");
            }
            $isUpdate = false;
            $properties = get_object_vars($record);
            foreach ($data as $key => $value) {
                if (array_key_exists($key, $properties)) {
                    $isUpdate = true;
                    $record->{$key} = $value;
                }
            }
            $result = $this->_updateJoins($id, $data);
            if ($isUpdate && !$record->update()) {
                $messages = [];
                foreach ($record->getMessages() as $message)  {
                    $messages[] = $message->getMessage();
                }
                throw new Exception(implode(', ', $messages));
            }
        } catch (\Exception $e) {
            $db->rollBack();
            throw $e;
        }
        $db->commit();

        return $result;
    }

    /**
     * Update data to joins tables by reference ids
     *
     * @param integer|string $id
     * @param array $data
     * @return bool|array
     */
    protected function _updateJoins($id, array $data)
    {
        $result = true;
        foreach ($this->_joins as $model) {
            $referenceColumn = $model->getReferenceFields($this->_model);
            if (!$referenceColumn) {
                continue;
            }
            $records = $model->findByColumn($referenceColumn, [$id]);
            foreach ($records as $record) {
                $isUpdate = false;
                $properties = get_object_vars($record);
                foreach ($data as $key => $value) {
                    if (array_key_exists($key, $properties)) {
                        $isUpdate = true;
                        $record->$key = $value;
                    }
                }
                if ($isUpdate && !$record->update()) {
                    $messages = [];
                    foreach ($record->getMessages() as $message)  {
                        $messages[] = $message->getMessage();
                    }
                    throw new Exception(implode(', ', $messages));
                }
            }
        }

        return $result;
    }

    /**
     * Delete rows by primary value
     *
     * @param array|string|integer $ids
     * @return bool|array
     */
    public function delete($ids)
    {
        if (!is_array($ids)) {
            $ids = [$ids];
        }
        $db = $this->_model->getWriteConnection();
        $db->begin();
        try {
            $records = $this->_model->findByIds($ids);
            foreach ($records as $record) {
                if (!$record->delete()) {
                    $messages = [];
                    foreach ($record->getMessages() as $message) {
                        $messages[] = $message->getMessage();
                    }
                    throw new Exception(implode(', ', $messages));
                }
            }
        } catch (\Vein\Core\Exception $e) {
            $db->rollBack();
            throw $e;
        }
        $db->commit();

        return true;
    }
}