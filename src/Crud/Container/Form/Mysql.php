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
     *
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
     *
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
     *
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
     * Initialize container model
     *
     * @return void
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

        $this->_model->_skipAttributes(array_intersect($this->_fields[get_class($this->_model)], $notRequeired));
        foreach ($this->_joins as $key => $model) {
            $model->_skipAttributes(array_intersect($this->_fields[$key], $notRequeired));
        }
    }

    /**
     * Initialize data source object
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
     *
	 * @return array
	 */
    public function loadData($id)
    {
        $dataSource = $this->getDataSource();
        $primary = $this->_model->getPrimary();
        $alias = $dataSource->getCorrelationName($primary);
        $dataSource->where($alias.'.'.$primary." = :id:", ['id' => $id]);
        $result = $dataSource->getQuery()->execute()->toArray();

        return ($result ? $result[0] : false);
    }
	
	/**
	 * Insert new item
	 * 
	 * @param array $data
     *
	 * @return integer
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
                $joinResult = $this->_insertToJoins($data, $record);
                $result = $id;
            } else {
                $messages = [];
                $this->_errors = [];
                foreach ($record->getMessages() as $message) {
                    $result = [];
                    $field = $message->getField();
                    $result[] = "Field: ".$field;
                    $result[] = "Type: ".$message->getType();
                    $errorMessage = $message->getMessage();
                    $result[] = "Message: ".$errorMessage;
                    $messages[] = implode (", ", $result);
                    //$messages[] = $message->getMessage();
                    $this->_errors[$field] = $errorMessage;
                }
                throw new Exception(implode('; ', $messages));
            }
		} catch (Exception$e) {
            $db->rollBack();
            throw $e;
		}
        $db->commit();

		return $result;
	}
	
	/**
	 * Insert new data to joins by reference id
	 *
	 * @param array $data
     * @param \Vein\Core\Mvc\Model $parentRecord
     *
	 * @return array
	 */
	protected function _insertToJoins(array $data, Model $parentRecord)
	{
        $result = [];
	    foreach ($this->_joins as $model) {
	        $referenceColumn = $model->getReferenceFields($this->_model);
            if (!$referenceColumn) {
                continue;
            }
            $relationColumn = $model->getRelationFields($this->_model);
            $properties = get_object_vars($parentRecord);
            $updateParent = false;
            if (array_key_exists($relationColumn, $properties)) {
                $updateParent = true;
                $referenceValue = $parentRecord->{$relationColumn};
                if ($referenceValue !== null) {
                    $data[$referenceColumn] = $referenceValue;
                }
            }
            $record = clone($model);
            $isCreate = false;
            $properties = get_object_vars($record);
            foreach ($data as $key => $value) {
                if (array_key_exists($key, $properties)) {
                    $isCreate = true;
                    $record->$key = $value;
                }
            }
            if (!$isCreate) {
                continue;
            }

            if ($record->save()) {
                $primary = $record->getPrimary();
                $result[] = $record->{$primary};
                if ($updateParent) {
                    $parentRecord->{$relationColumn} = $record->{$referenceColumn};
                    if (!$parentRecord->save()) {
                        $messages = [];
                        $this->_errors = [];
                        foreach ($parentRecord->getMessages() as $message) {
                            $result = [];
                            $field = $message->getField();
                            $result[] = "Field: ".$field;
                            $result[] = "Type: ".$message->getType();
                            $errorMessage = $message->getMessage();
                            $result[] = "Message: ".$errorMessage;
                            $messages[] = implode (", ", $result);
                            //$messages[] = $message->getMessage();
                            $this->_errors[$field] = $errorMessage;
                        }
                        throw new Exception(
                            'Update in model \''.get_class($parentRecord).'\' failed: '.
                            implode('; ', $messages)
                        );
                    }
                }
            } else {
                $messages = [];
                $this->_errors = [];
                foreach ($record->getMessages() as $message) {
                    $result = [];
                    $field = $message->getField();
                    $result[] = "Field: ".$field;
                    $result[] = "Type: ".$message->getType();
                    $errorMessage = $message->getMessage();
                    $result[] = "Message: ".$errorMessage;
                    $messages[] = implode (", ", $result);
                    //$messages[] = $message->getMessage();
                    $this->_errors[$field] = $errorMessage;
                }
                throw new Exception(
                    'Insert in model \''.get_class($record).'\' failed: '.
                    implode('; ', $messages)
                );
            }
	    }
        
	    return $result;
	}

    /**
     * Update rows by primary id values
     *
     * @param array $id
     * @param array $data
     *
     * @return bool
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
            $result = $this->_updateJoins($data, $record);
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
     * @param array $data
     * @param \Vein\Core\Mvc\Model $parentRecord
     *
     * @return bool
     */
    protected function _updateJoins(array $data, Model $parentRecord)
    {
        $result = true;
        foreach ($this->_joins as $model) {
            $referenceColumn = $model->getReferenceFields($this->_model);
            if (!$referenceColumn) {
                continue;
            }
            $relationColumn = $model->getRelationFields($this->_model);
            $referenceValue = $parentRecord->{$relationColumn};
            if ($referenceValue === null) {
                continue;
            }

            $records = $model->findByColumn($referenceColumn, [$referenceValue]);
            foreach ($records as $record) {
                $isUpdate = false;
                $properties = get_object_vars($record);
                foreach ($data as $key => $value) {
                    if (
                        array_key_exists($key, $properties) &&
                        $record->{$key} != $value
                    ) {
                        $isUpdate = true;
                        $record->{$key} = $value;
                    }
                }
                if ($isUpdate) {
                    if (!$record->update()) {
                        $messages = [];
                        foreach ($record->getMessages() as $message) {
                            $messages[] = $message->getMessage();
                        }
                        throw new Exception(
                            'Update in model \'' . get_class($record) . '\' failed: ' .
                            implode(', ', $messages)
                        );
                    } elseif ($record->isInsertInsteadUpdate()) {
                        $referenceValue = $record->{$referenceColumn};
                        if ($referenceValue != $parentRecord->{$relationColumn}) {
                            $parentRecord->{$relationColumn} = $referenceValue;
                            if (!$parentRecord->save()) {
                                $messages = [];
                                $this->_errors = [];
                                foreach ($parentRecord->getMessages() as $message) {
                                    $result = [];
                                    $field = $message->getField();
                                    $result[] = "Field: ".$field;
                                    $result[] = "Type: ".$message->getType();
                                    $errorMessage = $message->getMessage();
                                    $result[] = "Message: ".$errorMessage;
                                    $messages[] = implode (", ", $result);
                                    //$messages[] = $message->getMessage();
                                    $this->_errors[$field] = $errorMessage;
                                }
                                throw new Exception(
                                    'Update in model \'' . get_class($parentRecord) . '\' failed: ' .
                                    implode('; ', $messages)
                                );
                            }
                        }
                    }
                }
            }
        }

        return $result;
    }

    /**
     * Delete rows by primary value
     *
     * @param integer $ids
     *
     * @return bool
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
        } catch (Exception $e) {
            $db->rollBack();
            throw $e;
        }
        $db->commit();

        return true;
    }
}