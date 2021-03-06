<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud;

use	Phalcon\Events\EventsAwareInterface,
	Phalcon\DI\InjectionAwareInterface,
	Vein\Core\Forms\Form as CoreForm,
	Vein\Core\Crud\Form\Field,
	Vein\Core\Crud\Container\Container,
	Vein\Core\Crud\Form\Exception,
	Vein\Core\Tools\Strings;
		
/**
 * Class for manage data.
 *
 * @uses       \Vein\Core\Crud\Form\Exception
 * @uses       \Vein\Core\Crud\Form\Field
 * @uses       \Vein\Core\Forms\Form
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Form
 */
abstract class Form implements
    \ArrayAccess,
    EventsAwareInterface,
    InjectionAwareInterface
{
    use \Vein\Core\Tools\Traits\DIaware,
        \Vein\Core\Tools\Traits\EventsAware,
        \Vein\Core\Tools\Traits\Resource,
        \Vein\Core\Crud\Tools\Renderer,
        \Vein\Core\Crud\Tools\Attributes;

    /**
     * Default container name
     */
    const DEFAULT_CONTAINER = 'Mysql';

    /**
     * Default decorator
     */
    const DEFAULT_DECORATOR = 'Standart';
	
	/**
	 * Phalcon form
	 * @var \Vein\Core\Forms\Form
	 */
	protected $_form;
	
	/**
	 * Form fields
	 * @var array
	 */
	protected $_fields = [];

    /**
     * Array of form field names as keys and model field names as values
     * @var array
     */
    protected $_fieldNames = [];

    /**
     * Form title
     * @var string
     */
    protected $_title;
	
	/**
	 * Form field groups
	 * @var array
	 */
	protected $_groups = [];

	/**
	 * Form item id
	 * @var integer|string
	 */
	protected $_id = null;
	
	/**
	 * Additional data array
	 * @var array
	 */
	protected $_addData = [];
	
	/**
	 * Load data from form model
	 * @var array
	 */
	protected $_loadData = [];
	
	/**
	 * Data container object
	 * @var \Vein\Core\Crud\Container\Form\Adapter
	 */
	protected $_container;
		
	/**
	 * Container adapter class name
	 * @var string
	 */
	protected $_containerAdapter = null;
	
	/**
	 * Container model
	 * 
	 * @var string|object
	 */
	protected $_containerModel = null;

    /**
     * Container condition
     * @var array|string
     */
    protected $_containerConditions = null;

    /**
     * Container joins
     * @var array|string
     */
    protected $_containerJoins = [];
	
	/**
	 * Filter params
	 * @var array
	 */
	protected $_params = [];
	
	/**
	 * Form action
	 * @var string
	 */
	protected $_action;
	
	/**
	 * Form action method
	 * @var string
	 */
	protected $_method = 'post';
	
	/**
	 * Form created flag
	 * @var bool
	 */
	private $_formCreated = false;
	
	/**
	 * Insert flag
	 * @var bool
	 */
	private $_isInsertData = false;
	
	/**
	 * Update flag
	 * @var bool
	 */
	private $_isUpdateData = false;

    /**
     * Template for generate form item link
     * @var string
     */
    protected $_linkTemplate = false;

    /**
     * Can be remove data from container
     * @var bool
     */
    protected $_notRemove = false;

	/**
	 * Errors after failed action
	 * @var array
	 */
	protected $_errors = [];

    /**
     * Constructor
     *
     * @param integer|string $id
     * @param array $params
     * @param \Phalcon\DiInterface $dependencyInjector
     * @param \Phalcon\Events\ManagerInterface $eventsManager
     */
    public function __construct(
        $id = null,
        array $params = [],
        DiInterface $dependencyInjector = null,
        ManagerInterface $eventsManager = null
    ) {
        if ($dependencyInjector) {
            $this->setDi($dependencyInjector);
        }
        if ($eventsManager) {
            $this->setEventsManager($eventsManager);
        }
        $this->_initResource();
        $this->init();
        $this->_id = $id;
    	$this->_params = $params;
		
		$this->init();
		$this->_autoloadInitMethods();
		$this->_autoloadSetupMethods();
	}
	
	/**
     * Initialize form (used by extending classes)
     *
     * @return void
     */
	public function init()
	{
	}
	
	/**
	 * Initialize grid container object
	 * 
	 * @return void
	 */
	protected function _initContainer()
	{
		if (null !== $this->_container) {
			$config = [];
			$config['container'] = $this->_container;
            $config['conditions'] = $this->_containerConditions;
            $config['joins'] = $this->_containerJoins;
            $this->_container = Container::factory($this, $config);
		} else {
			$config = [];
			$config['adapter'] = (null === $this->_containerAdapter) ? static::DEFAULT_CONTAINER : $this->_containerAdapter;
			$config['model'] = $this->_containerModel;
            $config['conditions'] = $this->_containerConditions;
            $config['joins'] = $this->_containerJoins;
			$this->_container = Container::factory($this, $config);
		}
        $this->_container->setDi($this->getDi());
        $this->_container->setEventsManager($this->getEventsManager());
	}

    /**
     * Initialize decorator
     *
     * @return void
     */
    protected function _initDecorator()
    {
        $this->_decorator = static::DEFAULT_DECORATOR;
    }
	
    /**
     * Return form container adapter
     *
     * @return \Vein\Core\Crud\Container\Form\Adapter
     */
    public function getContainer()
    {
    	return $this->_container;
    }
	
	/**
	 * Initialize form fields
	 * 
	 * @return void
	 */
	abstract protected function _initFields();
	
	/**
	 * Setup form
	 *
	 * @return void
	 */
    protected function _setupForm()
    {
        $this->_fieldNames = [];
        foreach ($this->_fields as $key => $field) {
			/* @var \Vein\Core\Crud\Form\Field $field */
			$field->setDi($this->_di);
			$field->setEventsManager($this->_eventsManager);
            $field->init($this, $key);
            if (!$field->isAddToContainer()) {
                continue;
            }
			if ($field instanceof Field\Submit) {
				continue;
			}
            $this->_fieldNames[$key] = $field->getName();
        }
        if (null !== $this->_id) {
            $this->loadData($this->_id);
        } else {
            $this->setData($this->_params);
        }
    }
	
	/**
	 * Setup form fields
	 *
	 * @return void
	 */
	protected function _setupFields()
	{		
	}

	/**
	 * Initialize form elements
	 * 
	 * @return \Vein\Core\Crud\Form
	 */
	public function initForm()
	{
        if ($this->_formCreated) {
            return $this;
        }

		$this->_form = new CoreForm();
    	foreach ($this->_fields as $key => $field) {
            if ($this->_id === null) {
            }
			/* @var \Vein\Core\Crud\Form\Field */
    		$elements = $field->getElement();
    		$field->updateField();
    		if (!is_array($elements)) {
    			$elements = [$elements];
    		}
    		foreach ($elements as $element) {
    			if (!($element instanceof \Phalcon\Forms\Element)) { 
    				throw new Exception('Element not instance if \Phalcon\Forms\Element');
    			}
    			$this->_form->add($element);
    		}
    	}
    	$this->_form->setAction($this->getAction())->setMethod($this->getMethod());
    	//$this->setElementsBelongTo(NULL);
    	$this->_formCreated = true;

        return $this;
	}
	
	/**
	 * Return phalcon form object
	 * 
	 * @return \Vein\Core\Forms\Form
	 */
	public function getForm()
	{
		return $this->_form;
	}

    /**
     * Return form title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->_title;
    }

    /**
     * Return form primary field
     *
     * @return \Vein\Core\Crud\Form\Field\Primary
     */
    public function getPrimaryField()
    {
        foreach ($this->_fields as $field) {
            if ($field instanceof Field\Primary) {
                return $field;
            }
        }

        return false;
    }
	
	/**
	 * Set form data.
	 * 
	 * @param array $data
	 * @param bool $useFormFieldName
     *
     * @return \Vein\Core\Crud\Form
	 */
	public function setData(array $data, $useFormFieldName = false)
	{
		$data = $this->fixData($data);
		if ($this->_form) {
			$this->_form->setData($data);
		}
		foreach ($this->_fields as $field) {			
			if (null !== $this->_id) {
				$field->setId($this->_id);
			}

			if ($field instanceof Field\Submit) {
				continue;
			}
			
			/*if ($field instanceof Field\TranslationText) {
				$values = false;
				$key = $field->getKey();
				if (isset($data[$key]) && is_array($data[$key])) {
					$values = $data[$key];
				} else {
					$names = $field->getNames();
					foreach ($names as $code => $name) {					
						if (isset($data[$name])) {
							if ($values === false) {
								$values = [];
							}
							$values[$code] = $data[$name];
						}
					}
				}
				if ($values === false && $this->_id === null) {
					continue;
				}
				$field->setValue($values);
				$data['translations'][$key] = $field->getValue();
			} else {*/
            if ($field instanceof Field) {
				$key = ($useFormFieldName) ? $field->getName() : $field->getKey();
				if (array_key_exists($key, $data)) {
					$field->setValue($data[$key]);
				}
			}
		}
		
		return $this;
	}
	
	/**
	 * Load data from container
	 * 
	 * @param integer|string $id
     *
     * @return boolean
	 */
	public function loadData($id)
    {
        $this->clearData();
        $this->_id = $id;
        foreach ($this->_fieldNames as $key => $name) {
            $this->_container->setColumn($key, $name, true, true);
        }
        $result = $this->_container->loadData($id);
        if ($result) {
            $this->_loadData = $result;
            $this->setData($this->_loadData);
        } else {
            return false;
        }

        return true;
    }
	
	/**
	 * Return merged form data
	 * 
	 * @return array
	 */
	public function getData()
	{
		$data = [];
		foreach ($this->_fields as $key => $field) {
			$value = $field->getValue();
            if (Strings::isFloat($value)) {
				$value = floatval($value);
			} elseif (Strings::isInt($value)) {
				$value = (int) $value;
            }
            $data[$key] = $value;
		}

		$data = array_merge($this->_addData, $data);
		
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
            return false;
        }
        return \Vein\Core\Tools\Strings::generateStringTemplate($this->_linkTemplate, $this->getData(), "{", "}");
    }
	
	/**
	 * Return data array with rendered values
	 * 
	 * @return array
	 */
	public function getRenderData() 
	{
		$data = [];
		foreach ($this->_fields as $key => $field) {
			$data[$key] = $field->getRenderValue();
		}
		$data = $data = array_merge($this->_addData, $data);
		
		return $data;
	}
	
	/**
	 * Clear form data and set null value into all form fields.
	 * 
	 * @return \Vein\Core\Crud\Form
	 */
	public function clearData() 
	{
        $this->_loadData = [];
		$this->_addData = [];
		if (empty($this->_fields)) {
			return $this;
		}
		foreach ($this->_fields as $field) {
			if ($field instanceof Field\Submit) {
				continue;
			}
			$field->setValue(null);
		}
		$this->_id = null;
		
		return $this;
	}
	
	
	/**
	 * Add new value to additional data array
	 * 
	 * @param string $key
	 * @param string $value
     *
     * @return \Vein\Core\Crud\Form
	 */
	public function addAdditionalValue($key, $value) 
	{
		$this->_addData[$key] = $value;
		
		return $this;
	}

	/**
	 * Set additional data array
	 * 
	 * @param array $data
     *
     * @return \Vein\Core\Crud\Form
	 */
	public function setAdditionalData(array $data) 
	{
		$this->_addData = $data;
		
		return $this;
	}
	
	/**
	 * Fix data array
	 * 
	 * @param array $data
     *
     * @return array
	 */
	public function fixData($data)
	{
	    return $data;
	}
	
	/**
	 * Is form was created
	 * 
	 * @return bool
	 */
	public function isFormCreated()
	{
		return $this->_formCreated;
	}
	
	/**
     * Validate the form
     *
     * @param array $data
     *
     * @return boolean
     */
	public function isValid($data)
	{
		if (!$this->isFormCreated()) {
	        throw new Exception('Form not init!');
	    }
        $this->beforeValidate($data);

		foreach ($this->_fields as $field) {

			if ($field instanceof Field\Submit) {
				continue;
			} elseif ($field instanceof Field\Security) {
				if (!$field->isValid($data)) {
					throw new Exception('Form security invalid');
				}
			} else {
				$key = $field->getKey();
				$value = (array_key_exists($key, $data)) ? $data[$key] : null;
				if (!$field->isValid($value)) {
					if ($value === null) {
						$value = 'null';
					} elseif ($value === false) {
						$value = 'false';
					}
					throw new Exception('Value \'' . $value . '\' for form field \'' . $key . '\' invalid');
				}
			}
		}
        if (!$this->validate($data) || !$this->_form->isValid($data)) {
            return false;
        }
        $this->setData($data);

	    return true;
	}

    /**
     * Check and filtering data before validation
     *
     * @param array $data
     *
     * @return mixed
     */
    protected function beforeValidate(&$data) { }

    /**
     * Custom validation
     *
     * @param array $data
     * return boolean
     */
    protected function validate(array $data)
    {
        return true;
    }

    /**
     * Do something before render
     *
     * @return string
     */
    protected function _beforeRender()
    {
	    if (!$this->isFormCreated()) {
	        //throw new \Vein\Core\Exception('Form not init!');
	    }
	}
    
    /**
    * Retrieve form messages from elements failing validations
    *
    * @param string $name
    * @return array
    */
    public function getMessages($name = null)
    {
    	return $this->_form->getMessages($name);
    }
    
	/**
	 * Action before _insert or _update.
	 * Call preSaveAction action in all form field objects.
	 * 
	 * @return void
	 */
	final protected function _preSave()
	{
		$this->preSave();
		
	    if (null !== $this->_id) {
	        $this->beforeUpdate();
	    } else {
	        $this->beforeInsert();
	    }
	    $data = $this->getData();
		foreach ($this->_fields as $key => $field) {
			$field->preSaveAction($data);
		}
	}
	
	/**
	 * Before save trigger function
	 */
	protected function preSave() {}
	
	/**
	 * Before insert trigger function
	 */
    protected function beforeInsert() {}
	
    /**
     * Before update trigger function
     */
    protected function beforeUpdate() {}

    /**
     * Save form data to database
     * 
     * @params array $data
	 *
     * @return integer
     */
	public function save(array $data = [], $validate = true)
	{
		if (!$this->isFormCreated()) {
	        throw new Exception('Form not init!');
	    }
        if (empty($data)) {
            $data = $this->getData();
        }
        $this->_container->initialaizeModels();

        if ($validate) {
            if (!$this->isValid($data)) {
                $messages = [];
				$this->_errors = [];
                foreach ($this->_form->getMessages() as $message) {
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
        }

		$this->_preSave();

		$data = [];
		$saveData = [];
		$alter = [];
		foreach ($this->_fields as $key => $field) {			
			$d = $field->getSaveData();
			if (!$d) {
				$alter[] = $key;
				continue;
			}
            /*if ($field instanceof Field\TranslationText) {
                if (!isset($saveData['translations'])) {
                    $saveData['translations'] = [];
                }
                $saveData['translations'][$d['data']['key']] = $d['data']['value'];
            } else {*/
            $saveData[$d['key']] = $d['value'];
            //}

		}

	    if (null !== $this->_id) {
	        $result = $this->_update($this->_id, $saveData);
		    $this->_isInsertData = false;
		    $this->_isUpdateData = true;
	    } else {
		    $result = $this->_insert($saveData);
		    if (is_array($result) && isset($result['error'])) {
		        return $result;
		    }
		    $this->_isUpdateData = false;
		    $this->_isInsertData = true;
		    $this->loadData($result);
	    }

		$this->_postSave();

		return $this->_id;
	}
	
	/**
	 * Insert new row in form model.
	 * 
	 * @param array $data
     *
     * @return bool|array
	 */
	protected function _insert(array $data)
	{
	    return $this->_container->insert($data);
	}
	
	/**
	 * Update row by primary id value.
	 * 
	 * @param string $id
	 * @param array $data
     *
     * @return bool|array
	 */
	protected function _update($id, $data)
	{  
	    return $this->_container->update($id, $data);
	}
	
	/**
	 * Action after _insert or _update.
	 * Call postSaveAction action in all form field objects.
	 * 
	 * @return void
	 */
	final protected function _postSave()
	{
		$data = $this->getData();
		foreach ($this->_fields as $field) {
			$field->postSaveAction($data);
		}
		if ($this->_isInsertData) {
		    $this->afterInsert();
		}
	    if ($this->_isUpdateData) {
		    $this->afterUpdate();
		}
		$this->postSave();
	}
	
	/**
	 * After insert trigger function
	 */
	protected function afterInsert() {}
	
	/**
	 * After update trigger function
	 */
    protected function afterUpdate() {}
    
    /**
	 * After save trigger function
	 */
    protected function postSave() {}
	
    /**
     * Update some field
     * 
     * @param int $id
     * @param array $data
     *
     * @return array|bool
     */
	public function update($id, array $data) 
	{
        $this->_container->initialaizeModels();
		$messages = [];
		$this->_errors = [];
		foreach ($data as $name => $value) {
			$element = $this->getElement($name);
			if (! $element) {
				unset ($data[$name]);
				continue;
			}
			if ($element->isValid($value) !== true) {
                $messages = [];
                foreach ($element->getMessages() as $message) {
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
			} else {
				$field = $this->getName($name);
				$field->setValue($value);
				$d = $field->getSaveData();
				if (!$d) {
					$alter[] = $name;
					continue;
				}
				if ($d['model'] == 'default') {
					$data[$d['data']['key']] = $d['data']['value'];
				}
			}
		}

		if ($messages) {
			throw new Exception(implode('; ', $messages));
		}

		$data = array_merge($this->_addData, $data);
		$result = $this->_update($id, $data);

		return ($result === 0) ? true : $result;

	}

	/**
	 * Remove rows by id values.
	 * 
	 * @param string|array $ids
     *
     * @return string
	 */
	public function delete($id = null)
	{
        $this->_container->initialaizeModels();
        if (!$this->isRemovable()) {
            return false;
        }
        if (null === $id) {
            if (null === $this->_id) {
                return false;
            }
            $id = $this->_id;
        }
        if (!is_string($id)) {
            throw new Exception("Data type incorrect");
        }

	    return $this->_container->delete($id);
	}
	
	/**
	 * Dublicate items
	 * 
	 * @param array|integer $ids
     *
     * @return array
	 */
	public function duplicate($ids) 
	{
        $this->_container->initialaizeModels();
		if (!is_array($ids)) {
			$ids = [$ids];
		}
		$primary = $this->_container->getModel()->getPrimary();
		$new = [];
		$form = clone($this);
		$form->clearData();
				
		foreach ($ids as &$id) {
			$data = $form->loadData($id)->getData();	
			$form->clearData();
			if (isset($data[$primary])) {			
				unset($data[$primary]);
			}
			if ($primary !== 'id' && isset($data['id'])) {
				unset($data['id']);
			}
			$this->fixDuplicateRowData($data);
			$result = $form->saveData($data);
			if ($result === false) {
				print_r($form->getErrors());die;
				throw new \Vein\Core\Exception("Data no duplicate with error");
			} elseif (is_array($result)) {
				throw new \Vein\Core\Exception("Data no duplicate with error ".$result['error']);
			} 
			$new[] = $result;
		}
		
		return $new;
	}
	
	/**
	 * Fix duplicate data
	 * 
	 * @param array $data
     *
     * @return void
	 */
	public function fixDuplicateRowData(&$data)
	{	
	}

    /**
     * Return primary form value
     *
     * @return string
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Is data can be remove(delete) from container
     *
     * @return bool
     */
    public function isRemovable()
    {
        return !$this->_notRemove;
    }

    /**
     * Data can not be remove(delete) from container
     *
     * @return \Vein\Core\Crud\Form
     */
    public function notRemovable()
    {
        $this->_notRemove = true;
        return $this;
    }

    /**
     * Return if exists Field by form field key
     *
     * @param string $name
     *
     * @return \Vein\Core\Crud\Form\Field
     */
    public function getFieldByKey($key)
    {
        if (isset($this->_fields[$key])) {
            return $this->_fields[$key];
        }

        return false;
    }

	/**
	 * Return if exists form field by field name
	 * 
	 * @param string $name
     *
     * @return \Vein\Core\Crud\Form\Field
	 */
	public function getFieldByName($name) 
	{
		foreach ($this->_fields as $key => $field) {
			$c_name = $field->getName();
			if ($c_name === $name) {
			    return $field;
			}
		}
		
		return false;
	}

	/**
	 * Return if exists field key by name
	 * 
	 * @param string $name
     *
     * @return string
	 */
	public function getFieldKeyByName($name) 
	{
		if ($field = $this->getFieldByName($name)) {
			return $field->getKey();
		}
		
		return false;
	}
	
	/**
	 * Return if exists field name by key
	 * 
	 * @param string $key
     *
     * @return string
	 */
	public function getFieldNameByKey($key)
	{
		if (isset($this->_fields[$key])) {
			return $this->_fields[$key]->getName();
		}
		
		return false;
	}
    
    /**
     * return form's fields
     * 
     * @return \Vein\Core\Crud\Form\Field
     */
    
    public function getFields()
    {
        return $this->_fields;
    }


    /**
	 * Set form fields
	 * 
	 * @param array $fields
	 * @throws Exception
	 * @return \Vein\Core\Crud\Grid\Filter
	 */
	public function setFields(array $fields)
	{
		if (count($fields) == 0) {
		    return false;
		}
        $this->_fields = [];
		$this->addFields($fields);

		return $this;
	}
	
    /**
     * Add multiple elements at once
     *
     * @param array $elements
     *
     * @return \Vein\Core\Crud\Grid\Filter
     */
    public function addFields(array $fields)
    {
        foreach ($fields as $key => $spec) {
            $name = null;
            if (!is_numeric($key)) {
                $name = $key;
            }

            if (is_string($spec) || ($spec instanceof Field)) {
                $this->addElement($spec, $name);
                continue;
            }

            if (is_array($spec)) {
                $argc = count($spec);
                $options = [];
                if (isset($spec['type'])) {
                    $type = $spec['type'];
                	if (isset($spec['key'])) {
                        $name = $spec['key'];
                    }
                    if (isset($spec['name'])) {
                        $name = $spec['name'];
                    }
                    if (isset($spec['options'])) {
                        $options = $spec['options'];
                    }
                    $this->addField($type, $name, $options);
                } else {
                    switch ($argc) {
                        case 0:
                            continue 2;
                        case (1 <= $argc):
                            $type = array_shift($spec);
                        case (2 <= $argc):
                            if (null === $name) {
                                $name = array_shift($spec);
                            } else {
                                $options = array_shift($spec);
                            }
                        case (3 <= $argc):
                            if (empty($options)) {
                                $options = array_shift($spec);
                            }
                        default:
                           $this->addField($type, $name, $options);
                    }
                }
            }
        }
        
        return $this;
    }
	
   /**
     * Create an field
     *
     * @param string $type
     * @param array $options
     *
     * @return \Vein\Core\Crud\Form\Field
     */
    public function createField($type, array $options = null)
    {
        if (!is_string($type)) {
            throw new \Vein\Core\Exception('Element type must be a string indicating type');
        }

        $class = $this->getFieldClass($type);
		$rc = new \ReflectionClass($class);
		$field = $rc->newInstanceArgs($options);
		
        return $field;
    }
    
	/**
	 * Return filter field class name
	 * 
	 * @param string $type
     *
     * @return string
	 */
	public function getFieldClass($type)
	{
		return '\Vein\Core\Crud\Form\Field\\'.ucfirst($type);
	}
    
    /**
     * Add new field
     * 
     * @param \Vein\Core\Crud\Form\Field $field
     * @param string $key
     * @param array $options
	 * 
     * @return \Vein\Core\Crud\Form
     */
    public function addField($field, $key = null, array $options = [])
    {
    	if (is_string($field)) {
    		if (null === $key) {
                throw new \Vein\Core\Exception('Fields specified by string must have an accompanying name');
            }
    		$field = $this->createField($field, $key, $options);
    	}
    	if ($field instanceof Field\Field) {
            $key = $field->getKey();
		}
    	$field->init($this, $key);
		$this->_fields[$key] = $field;

        return $this;
    }

    /**
     * Return form action
     *
     * @return string
     */
    public function getAction()
    {
        /*$action = rtrim($this->_action, '/');
        $id = $this->getId();
        if ($id !== null) {
            $action .= '/'.$id;
        }*/

        return $this->_action;
    }

	/**
	 * Return action errors
	 *
	 * @return array
	 */
	public function getErrors()
	{
		return $this->_errors;
	}

    /**
     * Return form method
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->_method;
    }
    
    /**
    * Count of elements/subforms that are iterable
    *
    * @return int
    */
    public function count()
    {
    	return count($this->_fields);
    }
    
	/**
	 * Autoload all methods in class with prefix in function name _init
	 * 
	 * @return void
	 */
	private function _autoloadInitMethods()
	{
		$this->setAutoloadMethodPrefix('_init');
		$this->_runResourceMethods();
	}
	
	
	/**
	 * Autoload all methods in class with prefix in function name _setup
	 * 
	 * @return void
	 */
	private function _autoloadSetupMethods()
	{
		$this->setAutoloadMethodPrefix('_setup');
		$this->_runResourceMethods();
	}

    /**
     * Set value to form field
     *
     * @param string $key
     * @param mixed $value
	 *
     * @return \Vein\Core\Crud\Form
     * @throws \Exception if the $key is not a field in the form.
     */
    public function offsetSet($key, $value)
    {
        if (is_null($key)) {
            throw new \Vein\Core\Exception("Key can not be null");
        } elseif (!isset($this->_fields[$key])) {
            throw new \Vein\Core\Exception("Field with key \"$key\" not exists");
        }
        $this->_fields[$key]->setValue($value);

        return $this;
    }

    /**
     * Whether a field exists in the form
     *
     * @param string $offset
     *
     * @return bool
     */
    public function __isset($key)
    {
        return isset($this->_fields[$key]);
    }

    /**
     * $key to unset, this function depricated!
     *
     * @param string $offset
	 *
	 * @return void
     */
    public function __unset($key)
    {
        throw new \Vein\Core\Exception("Can not unset field in the form");
    }

    /**
     * Return form field value
     *
     * @param string $key
	 *
     * @return mixed
     * @throws \Exception if the $key is not a field in the form.
     */
    public function __get($key)
    {
        if (is_null($key)) {
            throw new \Vein\Core\Exception("Key can not be null");
        } elseif (!$key) {
            throw new \Vein\Core\Exception("Field key can not be empty");
        } elseif (!isset($this->_fields[$key])) {
            throw new \Vein\Core\Exception("Field \"$key\" is not in the form");
        }
        return $this->_fields[$key]->getValue();
    }

    /**
     * Set value to form field
     *
     * @param string $key
     * @param mixed $value
	 *
     * @return \Vein\Core\Crud\Form
     * @throws \Exception if the $key is not a field in the form.
     */
    public function __set($key, $value)
    {
        if (is_null($key)) {
            throw new \Vein\Core\Exception("Key can not be null");
        } elseif (!$key) {
            throw new \Vein\Core\Exception("Field key can not be empty");
        } elseif (!isset($this->_fields[$key])) {
            throw new \Vein\Core\Exception("Field with key \"$key\" not exists");
        }
        $this->_fields[$key]->setValue($value);

        return $this;
    }

    /**
     * Whether a field exists in the form
     *
     * @param string $offset
     *
     * @return bool
     */
    public function offsetExists($key)
    {
        return isset($this->_fields[$key]);
    }

    /**
     * $key to unset, this function depricated!
     *
     * @param string $offset
     *
     * @return void
     */
    public function offsetUnset($key)
    {
        throw new \Vein\Core\Exception("Can not unset field in the form");
    }

    /**
     * Return form field value
     *
     * @param string $key
	 *
     * @return mixed
     * @throws \Exception if the $key is not a field in the form.
     */
    public function offsetGet($key)
    {
        if (!isset($this->_fields[$key])) {
            throw new \Vein\Core\Exception("Field \"$key\" is not in the form");
        }
        return $this->_fields[$key]->getValue();
    }
}