<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Form;

use Vein\Core\Crud\Form,
    Phalcon\DiInterface as DiInterface;

/**
 * Class Extjs.
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Form
 */
abstract class Extjs extends Form
{
    /**
     * Default decorator
     */
    const DEFAULT_DECORATOR = 'Extjs';

    /**
     * Content managment system module router prefix
     * @var string
     */
    protected $_modulePrefix = 'cms';

    /**
     * Extjs module name
     * @var string
     */
    protected $_module;

    /**
     * Extjs form key
     * @var string
     */
    protected $_key;

    /**
     * Get grid action
     *
     * @return string
     */
    public function getModulePrefix()
    {
        return $this->_modulePrefix;
    }
    
    /**
     * Return extjs module name
     *
     * @return string
     */
    public function getModuleName()
    {
        return $this->_module;
    }

    /**
     * Return extjs form key
     *
     * @return string
     */
    public function getKey()
    {
        return $this->_key;
    }

    /**
     * Get form action
     *
     * @return string
     */
    public function getAction()
    {
        if (!empty($this->_action)) {
            return $this->_action;
        }
        return "/".$this->_modulePrefix."/".$this->getModuleName()."/".$this->getKey();
    }

    /**
     * Update form rows
     *
     * @param string|array|\stdClass $params
     * @param string $key
     * @param \Phalcon\DiInterface $dependencyInjector
     * @param \Phalcon\Events\ManagerInterface $eventsManager
     * @return array
     */
    public static function updateRows($params, $key, \Phalcon\DiInterface $dependencyInjector = null, \Phalcon\Events\ManagerInterface $eventsManager = null)
    {
        $result = [
            'success' => false,
            'error' => []
        ];

        if (is_string($params)) {
            if (!\Vein\Core\Tools\Strings::isJson($params)) {
                $result['error'][] = 'Params not valid';
                return $result;
            }
            $params = json_decode($params);
        }

        if (is_array($params)) {
            if (!isset($params[$key]) && !is_array($params[$key])) {
                $result['error'][] = 'Array params not valid';
                return $result;
            }
            $rows = (!isset($rows[0])) ? [$params[$key]] : $params[$key];
        } elseif ($params instanceof \stdClass) {
            if (!isset($params->$key)) {
                $result['error'][] = 'Object params not valid';
                return $result;
            }
            $rows = (is_object($params->$key)) ? [(array) $params->$key] : $params->$key;
        } else {
            $result['error'][] = 'Params not valid';
            return $result;
        }

        $false = false;
        foreach ($rows as $row) {
            $rowResult = self::updateRow($row, $dependencyInjector, $eventsManager);
            if ($rowResult['success'] === false) {
                $false = true;
                $result['error'] = array_merge($result['error'], $rowResult['error']);
            }
        }

        if (!$false) {
            $result['success'] = true;
            $result['msg'] = "Saved";
        }

        return $result;
    }

    /**
     * Update from row
     *
     * @param string|array|\stdClass $row
     * @param \Phalcon\DiInterface $dependencyInjector
     * @param \Phalcon\Events\ManagerInterface $eventsManager
     * @return array
     */
    public static function updateRow($row, \Phalcon\DiInterface $dependencyInjector = null, \Phalcon\Events\ManagerInterface $eventsManager = null)
    {
        $result = [
            'success' => false,
            'error' => []
        ];

        if (is_string($row)) {
            if (!\Vein\Core\Tools\Strings::isJson($row)) {
                $result['error'][] = 'Params not valid';
                return $result;
            }
            $row = json_decode($row);
        }

        if ($row instanceof \stdClass) {
            $row = (array) $row;
        } elseif (!is_array($row)) {
            $result['error'][] = 'Params not valid';
            return $result;
        }

        $form = new static(null, [], $dependencyInjector, $eventsManager);
        $primary = $form->getPrimaryField();
        $primaryKey = $primary->getKey();
        if (isset($row[$primaryKey])) {
            $id = $row[$primaryKey];
            $form->loadData($id);
            unset($row[$primaryKey]);
        }
        $form->initForm();
        foreach ($row as $key => $value) {
            if (!isset($form->$key)) {
                continue;
            }
            $form->$key = $value;
        }

        $rowResult = $form->save();
        if (is_array($rowResult)) {
            $result['error'] = array_merge($result['error'], $rowResult['error']);
        } else {
            $result['success'] = true;
            $result['id'] = $rowResult;
            $result['msg'] = "Saved";
        }

        return $result;
    }



    /**
     * Delete rows by id values.
     *
     * @param string|array $ids
     * @param \Phalcon\DiInterface $dependencyInjector
     * @param \Phalcon\Events\ManagerInterface $eventsManager
     * @return string
     */
    public static function deleteRows($params, $key, \Phalcon\DiInterface $dependencyInjector = null, \Phalcon\Events\ManagerInterface $eventsManager = null)
    {
        $result = [
            'success' => false,
            'error' => []
        ];

        if (is_string($params)) {
            if (!\Vein\Core\Tools\Strings::isJson($params)) {
                $result['error'][] = 'Params not valid';
                return $result;
            }
            $params = json_decode($params);
        }

        if (is_array($params)) {
            if (!isset($params[$key]) && !is_array($params[$key])) {
                $result['error'][] = 'Array params not valid';
                return $result;
            }
            $rows = (!isset($rows[0])) ? [$params[$key]] : $params[$key];
        } elseif ($params instanceof \stdClass) {
            if (!isset($params->$key)) {
                $result['error'][] = 'Object params not valid';
                return $result;
            }
            $rows = (is_object($params->$key)) ? [(array) $params->$key] : $params->$key;
        } else {
            $result['error'][] = 'Params not valid';
            return $result;
        }

        $false = false;
        $form = new static(null, [], $dependencyInjector, $eventsManager);
        if (!$form->isRemovable()) {
            $result['error'][] = 'Data can\'t be remove from this form';
        }
        $primary = $form->getPrimaryField();
        if (!$primary) {
            throw new \Vein\Core\Exception('Primary field not found');
        }
        $primaryKey = $primary->getKey();
        foreach ($rows as $id) {
            if (is_array($id)) {
                if (!isset($id[$primaryKey])) {
                    throw new \Vein\Core\Exception('Primary key not found in params');
                }
                $id = $id[$primaryKey];
            } elseif (is_object($id)) {
                if (!isset($id->{$primaryKey})) {
                    throw new \Vein\Core\Exception('Primary key not found in params');
                }
                $id = $id->{$primaryKey};
            }
            $resultRow = $form->delete($id);
            if ($resultRow === false) {
                $false = true;
                //$result['error'] = array_merge($result['error'], $rowResult['error']);
            }
        }

        if (!$false) {
            $result['success'] = true;
            $result['msg'] = "Deleted";
        }

        return $result;
    }

    /**
     * Return data in grid data type
     *
     * @return array
     */
    public function getGridData()
    {
        $result = $this->getData();
        $data = [];
        $data[$this->_key] = [$result];
        $data['results'] = 1;

        return $data;
    }

    /**
     * Generate form item link from link template
     *
     * @return string
     */
    public function getLink()
    {
        if (!$this->_linkTemplate) {
            $this->_linkTemplate = "/".$this->getModuleName()."/".$this->getKey();
            if ($primary = $this->getPrimaryField()) {
                $this->_linkTemplate .= "/{".$primary->getKey()."}";
            }
        }

        return $this->_linkTemplate;
    }
}