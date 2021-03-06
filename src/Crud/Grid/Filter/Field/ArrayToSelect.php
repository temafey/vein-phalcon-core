<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Grid\Filter\Field;

use Vein\Core\Filter\SearchFilterInterface as Criteria,
    Vein\Core\Crud\Container\AbstractContainer as Container;

/**
 * Grid filter field
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Grid
 */
class ArrayToSelect extends Standart
{
    /**
     * Field value data type
     * @var string
     */
    protected $_valueType = self::VALUE_TYPE_STRING;

	/**
	 * Form element type
	 * @var string
	 */
	protected $_type = 'select';
	
	/**
	 * Select options array
	 * @var array
	 */
	protected $_options = [];

	/**
	 * Null option
	 * @var string|array
	 */
	protected $_nullOption = -1;
		
	/**
	 * Onchange attribute action 
	 * @var string
	 */
	protected $_onChangeAction = false;

    /**
     * Add options to form element
     * @var bool
     */
    protected $_loadSelectOptions = true;
	
	/**
	 * Constructor
	 *
     * @param string $label
	 * @param string $name
     * @param array $options
	 * @param string $desc
	 * @param string $criteria
	 * @param int $width
	 * @param int $default
	 */
	public function __construct(
        $label = null,
        $name = null,
        array $options = [],
        $desc= null,
        $criteria = Criteria::CRITERIA_EQ,
        $width = 280,
        $default = null
    ) {
		parent::__construct($label, $name, $desc, $criteria, $width, $default);
	    $this->_options = $options;
	}

    /**
     * Update field
     *
     * @return void
     */
    public function updateField()
	{
		if ($this->_onChangeAction) {
			$this->_element->setAttribute('onchange', $this->_onChangeAction);
		}

		$options = [];
		if ($this->_loadSelectOptions !== false) {
			$options = $this->getOptions();
		}
        $nullValue = false;
        if ($this->_nullOption) {
            if ($this->_nullOption == -1) {
                $nullValue = -1;
                $null = [-1 => '-'];
            } elseif (is_string($this->_nullOption)) {
                $null = ['' => $this->_nullOption];
                $nullValue = '';
            } elseif (is_array($this->_nullOption)) {
                $null = $this->_nullOption;
                $nullValue = array_keys($this->_nullOption)[0];
            }
            $options = $null + $options;
        }
        $this->_element->setOptions($options);

        $values = $this->getValue();
        if (!$values && $values !== "0") {
            $this->setValue($nullValue);
        }
	}
	
   /**
   	* Return options array
   	*
   	* @return array
  	*/	
	public function getOptions()
	{
		return $this->_options;
	}
	
	/**
	 * Set filter options array
	 * 
	 * @param array $options
     *
     * @return \Vein\Core\Crud\Grid\Filter\Field
	 */
	public function setOptions(array $options)
	{
	    $this->_options = $options;
	    return $this;
	}
	
	/**
	 * Set nulled select option
	 * 
	 * @param string|array $option
     *
     * @return \Vein\Core\Crud\Grid\Filter\Field
	 */
	public function setNullOption($option)
	{
		$this->_nullOption = $option;
		return $this;
	}
	
	/**
	 * Set onchange action
	 * 
	 * @param string $onchange
     *
     * @return \Vein\Core\Crud\Grid\Filter\Field
	 */
	public function setOnchangeAction($onchange)
	{
		$this->_onChangeAction = $onchange;
		return $this;
	}

    /**
     * Return datasource filters
     *
     * @param \Vein\Core\Crud\Container\AbstractContainer $container
     *
     * @return \Vein\Core\Filter\SearchFilterInterface
     */
    public function getFilter(Container $container)
    {
        $values = $this->getValue();
        if ($values === null || $values === false || (is_string($values) && $values == '')) {
            return false;
        }

        $filters = [];
        if (!is_array($values)) {
            $values = [$values];
        }

        if (!$this->checkHashValue($values)) {
            return false;
        }

        foreach ($values as $val) {
            if (trim($val) == '' || $val == -1 || array_search($val, $this->_exceptionsValues)) {
                continue;
            }
            $filter = $container->getFilter('search', [$this->_name => $this->_criteria], $val);
            $filter->setFilterField($this);
            $filters[] = $filter;
        }
        $filter = $container->getFilter('compound', 'OR', $filters);
        $filter->setFilterField($this);

        return $filter;
    }

}
