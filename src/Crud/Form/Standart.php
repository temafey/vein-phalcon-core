<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Form;

use Vein\Core\Crud\Form,
    Phalcon\DiInterface as DiInterface,
    Vein\Core\Form\Exception as FormException,
    Vein\Core\Crud\Form\Exception as CrudFormException,
    Vein\Core\Crud\Container\Form\Exception as CrudFormContainerException;

/**
 * Class DataTable.
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Form
 */
abstract class Standart extends Form
{
    /**
     * Default decorator
     */
    const DEFAULT_DECORATOR = 'Standart';

    /**
     * Content managment system module router prefix
     * @var string
     */
    protected $_modulePrefix = 'admin';

    /**
     * DataTable module name
     * @var string
     */
    protected $_module;

    /**
     * DataTable form key
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
     * Return module name
     *
     * @return string
     */
    public function getModuleName()
    {
        return $this->_module;
    }

    /**
     * Return form key
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

        return '/'.$this->_modulePrefix.'/'.$this->getModuleName().'/'.$this->getKey().'/save';
    }

    /**
     * Get form id
     *
     * @return string
     */
    public function getFormId()
    {
        return \Phalcon\Text::camelize($this->_module).'_'.\Phalcon\Text::camelize($this->_key).'Form';
    }

    /**
     * Update form rows
     *
     * @param string|array|\stdClass $params
     * @param string $key
     * @param \Phalcon\DiInterface $dependencyInjector
     * @param \Phalcon\Events\ManagerInterface $eventsManager
     *
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
            $result['msg'] = 'Saved';
        }

        return $result;
    }

    /**
     * Update from row
     *
     * @param string|array|\stdClass $row
     * @param \Phalcon\DiInterface $dependencyInjector
     * @param \Phalcon\Events\ManagerInterface $eventsManager
     *
     * @return array
     */
    public static function updateRow($row, \Phalcon\DiInterface $dependencyInjector = null, \Phalcon\Events\ManagerInterface $eventsManager = null)
    {
        $resultData = [
            'success' => false,
            'errors' => []
        ];

        if (is_string($row)) {
            if (!\Vein\Core\Tools\Strings::isJson($row)) {
                $resultData['errors'][] = 'Params not valid';

                return json_encode($resultData);
            }
            $row = json_decode($row);
        }

        if ($row instanceof \stdClass) {
            $row = (array) $row;
        } elseif (!is_array($row)) {
            $resultData['errors'][] = 'Params not valid';

            return json_encode($resultData);
        }

        $form = new static(null, [], $dependencyInjector, $eventsManager);
        $primary = $form->getPrimaryField();
        $primaryKey = $primary->getKey();
        if (isset($row[$primaryKey])) {
            $id = $row[$primaryKey];
            unset($row[$primaryKey]);
            if ($id || $id === 0 || $id === '0') {
                $form->loadData($id);
            }
        }
        $form->initForm();
        foreach ($row as $key => $value) {
            if (!isset($form->$key)) {
                continue;
            }
            $form->$key = $value;
        }

        if (!$form->isValid($row)) {
            $errors = [];
            foreach ($form->getForm()->getMessages() as $message) {
                $result = [];
                $result[$message->getField()] = $message->getMessage();
                $errors[] = $result;
            }
            $resultData['errors'] = $errors;
        } else {
            try {
                $result = $form->save();
            } catch (CrudFormContainerException $e) {
                $result['success'] = false;
                $result['errors'] = $form->getContainer()->getErrors();
            } catch (CrudFormException $e) {
                $result['success'] = false;
                $result['errors'] = $form->getErrors();
            } catch (FormException $e) {
                $result['success'] = false;
                $result['errors'] = $form->getForm()->getErrors();
            } catch (\Exception $e) {
                $result['success'] = false;
                $result['errors'] = [$e->getMessage()];
            }
            if (is_array($result) && isset($result['errors'])) {
                $resultData['errors'] = $result['errors'];
            }
            elseif ($result) {
                $resultData['success'] = true;
                $resultData['data'][$result] = $form->getData();
            }
        }

        return $resultData;
    }

    /**
     * Delete rows by id values.
     *
     * @param string|array $params
     * @param \Phalcon\DiInterface $dependencyInjector
     * @param \Phalcon\Events\ManagerInterface $eventsManager
     *
     * @return string
     */
    public static function deleteRows($params, \Phalcon\DiInterface $dependencyInjector = null, \Phalcon\Events\ManagerInterface $eventsManager = null)
    {
        $resultData = [
            'success' => false,
            'errors' => [],
            'data' => []
        ];

        $key = 'data';

        if (is_string($params)) {
            if (!\Vein\Core\Tools\Strings::isJson($params)) {
                $resultData['errors'][] = 'Params not valid';

                return json_encode($resultData);
            }
            $params = json_decode($params);
        }

        if (is_array($params)) {
            if (!isset($params[$key]) && !is_array($params[$key])) {
                $resultData['errors'][] = 'Array params not valid';

                return json_encode($resultData);
            }
            $rows = $params[$key];
        } elseif ($params instanceof \stdClass) {
            if (!isset($params->$key)) {
                $resultData['errors'][] = 'Object params not valid';

                return json_encode($resultData);
            }
            $rows = (is_object($params->$key)) ? (array) $params->$key : $params->$key;
        } else {
            $resultData['errors'][] = 'Params not valid';

            return json_encode($resultData);
        }

        $false = false;
        $form = new static(null, [], $dependencyInjector, $eventsManager);
        if (!$form->isRemovable()) {
            $resultData['errors'][] = 'Data can\'t be remove from this form';

            return json_encode($resultData);
        }
        $primary = $form->getPrimaryField();
        if (!$primary) {
            $resultData['errors'][] = 'Primary field not found';
        }
        $primaryKey = $primary->getKey();
        foreach ($rows as $id) {
            if (is_array($id)) {
                if (!isset($id[$primaryKey])) {
                    $resultData['errors'][] = 'Primary key not found in params';
                }
                $id = $id[$primaryKey];
            } elseif (is_object($id)) {
                if (!isset($id->{$primaryKey})) {
                    $resultData['errors'][] = 'Primary key not found in params';
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
            $resultData['success'] = true;
        }

        return json_encode($resultData);
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
            $this->_linkTemplate = '/'.$this->getModuleName().'/'.$this->getKey();
            if ($primary = $this->getPrimaryField()) {
                $this->_linkTemplate .= '/{'.$primary->getKey().'}';
            }
        }

        return $this->_linkTemplate;
    }

}