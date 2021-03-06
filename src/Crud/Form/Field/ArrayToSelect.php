<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Form\Field;

use Vein\Core\Crud\Form\Field;

/**
 * Form field
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Form
 */
class ArrayToSelect extends Field
{
	/**
	 * Element type
	 * @var string
	 */
	protected $_type = 'select';

    /**
     * Field value type.
     * @var string
     */
    protected $_valueType = 'int';

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
     * @var bool
     */
    protected $_asynchron = true;
	
	/**
	 * Constructor
	 *
     * @param string $label
	 * @param string $name
	 * @param array $options
	 * @param string $label
	 * @param string $desc
	 * @param bool $required
	 * @param string $width
	 * @param string $default
	 */
	public function __construct(
        $label = null,
        $name = null,
        $options = [],
        $desc = null,
        $required = true,
        $width = 280,
        $default = null
    ) {
		parent::__construct($label, $name, $desc, $required, $width, $default);

		$this->setOptions($options);
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
        $this->_element->setOptions($options);

        $values = $this->getValue();
        if (!$values && $values !== "0") {
            $nullValue = false;
            if ($this->_nullOption) {
                if ($this->_nullOption == -1) {
                    $nullValue = -1;
                } elseif (is_string($this->_nullOption)) {
                    $nullValue = '';
                } elseif (is_array($this->_nullOption)) {
                    $nullValue = array_keys($this->_nullOption)[0];
                }
            }
            $this->setValue($nullValue);
        }
    }

    /**
     * Return field value
     *
     * @return string
     */
    public function getValue()
    {
        $value = parent::getValue();
        if ($this->_asynchron === false) {
            $options = $this->getOptions();
            $options = array_combine(array_values($options), array_keys($options));
            $value = $options[$value];
        }

        return $value;
    }
	
	/**
	 * Return rendered value
	 * 
	 * @return mixed
	 */
	public function getRenderValue()
	{
		$value = $this->getValue();
		$options = $this->getOptions();

		return (isset($options[$value]) ? $options[$value] : $value);
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
     * Set flag for not load select options
     *
     * @return \Vein\Core\Crud\Grid\Filter\Field
     */
    public function setNotLoadOptions()
    {
        $this->_loadSelectOptions = false;
        return $this;
    }
	
	/**
	 * Set options
	 * 
	 * @param array $options
     *
     * @return \Vein\Core\Crud\Form\Field\ArrayToSelect
	 */
	public function setOptions(array $options)
	{
        foreach ($options as $key => $value) {
            if (!is_numeric($key)) {
                $this->_valueType = 'string';
            }
        }
        $this->_options = $options;

		return $this;
	}

    /**
     * Return options array
     *
     * @return array
     */
    public function getOptions()
    {
        $options = $this->_options;
        $null = false;
        if ($this->_nullOption) {
            if ($this->_nullOption == -1) {
                $null = [-1 => '-'];
            } elseif (is_string($this->_nullOption)) {
                $null = ['' => $this->_nullOption];
            } elseif (is_array($this->_nullOption)) {
                $null = $this->_nullOption;
            }
            if ($null !== false) {
                $options = $null + $options;
            }
        }

        return $options;
    }
}
