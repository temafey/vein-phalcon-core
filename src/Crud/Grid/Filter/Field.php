<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Grid\Filter;

use Vein\Core\Crud\Grid\Filter,
    Vein\Core\Filter\SearchFilterInterface as Criteria,
    Vein\Core\Crud\Container\AbstractContainer as Container;

/**
 * Grid filter field
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Grid
 */
abstract class Field implements FieldInterface
{
    use \Vein\Core\Crud\Tools\Filters,
        \Vein\Core\Crud\Tools\Validators,
        \Vein\Core\Crud\Tools\FormElements,
        \Vein\Core\Crud\Tools\Renderer,
        \Vein\Core\Crud\Tools\Attributes;

	/**
	 * Filter criteria param
	 * @var string
	 */
	protected $_criteria;
	
	/**
	 * Filter
	 * @var \Vein\Core\Crud\Grid\Filter
	 */
	protected $_gridFilter;

    /**
     * @var bool
     */
    protected $_isArray = true;

    /**
     * Exception filter values
     * @var array
     */
    protected $_exceptionsValues = [];
	
	/**
     * Custom error messages
     * @var array
     */
	protected $_errorMessages = [];

    /**
     * Hashed value
     * @var string
     */
    protected $_hashValue;

    /**
     * Constructor
     *
     * @param string $label
     * @param string $name
     * @param string $desc
     * @param string $criteria
     */
    public function __construct(
        $label = null,
        $name = null,
        $desc = null,
        $criteria = \Vein\Core\Filter\SearchFilterInterface::CRITERIA_EQ
    ) {
        $this->_label = $label;
        $this->_name = $name;
        $this->_desc = $desc;
        $this->_criteria = $criteria;
    }

	/**
	 * Set filter object and init field key.
	 * 
	 * @param \Vein\Core\Crud\Grid\Filter $filter
	 * @param string $key
     *
     * @return \Vein\Core\Crud\Grid\Filter\Field
	 */
	public function init(\Vein\Core\Crud\Grid\Filter $filter, $key)
	{
		$this->_gridFilter = $filter;
		$this->_key = $key;
		if ($this->_name === null) {
		    $this->_name = $key;
		}
        $this->_init();
        $this->_initFilters();
        $this->_initHelpers();
		
		return $this;
	}
	
	/**
     * Initialize field (used by extending classes)
     *
     * @return void
     */
	protected function _init()
	{
	}

    /**
     * Initialize field helpers
     *
     * @return void
     */
    protected function _initHelpers()
    {
        $this->setHelpers([
            'standart',
            'volt\Label',
            'volt\Element',
            'volt\Message',
            'volt\Description'
        ]);
    }
	
	/**
	 * Update field
     *
	 * @return void
	 */
	public function updateField()
	{
	}

    /**
     * Apply field filter value to dataSource
     *
     * @param mixed $dataSource
     * @param \Vein\Core\Crud\Container\AbstractContainer $container
     *
     * @return \Vein\Core\Crud\Grid\Filter\Field
     */
    public function applyFilter($dataSource, Container $container)
    {
        if ($filter = $this->getFilter($container)) {
            $filter->applyFilter($dataSource);
        }

        return $this;
    }

    /**
     * Return filter object
     *
     * @return \Vein\Core\Crud\Grid\Filter
     */
    public function getGridFilter()
    {
        return $this->_gridFilter;
    }

    /**
     * Do something before render
     *
     * @return string
     */
    protected function _beforeRender()
    {
        $this->_element->setAttributes($this->getAttribs());
    }
	
    /**
     * Set error messages
     *
     * @param array|string $messages
     *
     * @return \Vein\Core\Crud\Grid\Filter\Field
     */
    public function setErrorMessages($messages)
    {
    	$this->_errorMessage = [];
    	if (is_array($messages)) {
    		$messages = array($messages);
    	}
    	foreach ($messages as $message) {
    		$this->_errorMessage = (string) $message;
    	}

        return $this->_errorMessage = $messages;
    }

    /**
     * Check if value was applied set
     *
     * @param mixed $value
     *
     * @return bool
     */
    public function checkHashValue($value)
    {
        $hashValue = sha1(serialize($value));
        if ($this->_hashValue === $hashValue) {
            return false;
        }

        $this->_hashValue = $hashValue;

        return true;
    }

    /**
     * Nulled field value
     *
     * @return \Vein\Core\Crud\Grid\Filter\Field
     */
    public function clearParam()
    {
        $this->setValue(false);
        $this->_hashValue = null;
        return $this;
    }
}