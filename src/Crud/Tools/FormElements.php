<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Tools;

use Vein\Core\Crud\Form\Field\TextArea,
    Phalcon\Forms\Element,
    Phalcon\Validation\Message;

/**
 * Trait FormElements
 *
 * @category    Vein\Core
 * @package     Crud
 * @subcategory Tools
 */
trait FormElements
{
    /**
     * Form element type
     * @var string
     */
    protected $_type;

    /**
     * Container column name
     * @var string
     */
    protected $_name;

    /**
     * Field name
     * @var string
     */
    protected $_key;

    /**
     * Field title
     * @var string
     */
    protected $_label;

    /**
     * Field description
     * @var string
     */
    protected $_desc;

    /**
     * Field width
     * @var integer
     */
    protected $_width;

    /**
     * Field form element
     * @var \Vein\Core\Forms\Element
     */
    protected $_element;

    /**
     * Field value type.
     * @var string
     */
    protected $_valueType = 'string';

    /**
     * Field value
     * @var string|integer|array
     */
    protected $_value = null;

    /**
     * Default field value
     * @var mixed
     */
    protected $_default = null;

    /**
     * Error message after validation
     * @var array
     */
    protected $_errorMessage = '';

    /**
     * Exception values
     * @var array
     */
    protected $_exceptionValues = [];

    /**
     * Normalize value flag
     * @var bool
     */
    protected $_normalizeValue = true;

    /**
     * Set field value
     *
     * @param string|integer|array $value
     * @return \Vein\Core\Crud\Tools\FormElements
     */
    public function setValue($value)
    {
        if ($this->_element instanceof Element) {
            $this->_element->setDefault($value);
        }
        $this->_value = $value;

        return $this;
    }

    /**
     * Set default field value
     *
     * @param string|integer|array $value
     * @return \Vein\Core\Crud\Tools\FormElements
     */
    public function setDefault($value)
    {
        $this->_default = $value;
        return $this;
    }

    /**
     * Set exception values
     *
     * @param array $value
     * @return \Vein\Core\Crud\Tools\FormElements
     */
    public function setExceptions(array $values)
    {
        $this->_exceptionValues = $values;
        return $this;
    }

    /**
     * Return field type
     *
     * @return string
     */
    public function getType()
    {
        return $this->_type;
    }

    /**
     * Return value field type.
     *
     * @return string
     */
    public function getValueType()
    {
        return $this->_valueType;
    }

    /**
     * Return field name
     *
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

    /**
     * Return field key
     *
     * @return string
     */
    public function getKey()
    {
        return $this->_key;
    }

    /**
     * Return field value
     *
     * @return string|array
     */
    public function getValue()
    {
        $value = ((null !== $this->_value) ? $this->_value : $this->_default);
        if ($this->_element instanceof Element) {
            $this->_element->setDefault($value);
            $value = $this->_element->getValue();
            if (null === $value) {
                $value = $this->_element->getDefault();
            }
        }

        if (null === $value) {
            return null;
        }
        if (false === $value) {
            return false;
        }

        if ($this->_normalizeValue) {
            $value = $this->normalizeValue($value);
        }

        return $this->filter($value);
    }

    /**
     * Set value normalize flag to false
     *
     * @return \Vein\Core\Crud\Tools\FormElements
     */
    public function notNormalizeValue()
    {
        $this->_normalizeValue = false;
        return $this;
    }

    /**
     * Normalize form field value
     *
     * @param string|array $value
     * @return mixed
     */
    public function normalizeValue($value)
    {
        return \Vein\Core\Tools\Strings::formSpecialChars($value);
    }

    /**
     * Return field label
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->_label;
    }

    /**
     * Return field description
     *
     * @return string
     */
    public function getDesc()
    {
        return $this->_desc;
    }

    /**
     * Return field width
     *
     * @return string
     */
    public function getwidth()
    {
        return $this->_width;
    }

    /**
     * set field label
     *
     * @param string $label
     * @return \Vein\Core\Crud\Form\Field
     */
    public function setLabel($label)
    {
        $this->_label = $label;
        return $this;
    }

    /**
     * Set field description
     *
     * @param string $desc
     * @return \Vein\Core\Crud\Form\Field
     */
    public function setDesc($desc)
    {
        $this->_desc = $desc;
        return $this;
    }

    /**
     * Set field width
     *
     * @param int $width
     * @return \Vein\Core\Crud\Form\Field
     */
    public function setwidth($width)
    {
        $this->_width = $width;
        return $this;
    }

    /**
     * Clear field
     *
     * @return \Vein\Core\Crud\Form\Field
     */
    public function clearField()
    {
        $this->_id = null;
        $this->_value = false;
        if ($this->_element instanceof Element) {
            $this->_element->setDefault($this->_default);
        }

        return $this;
    }

    /**
     * Set error message
     *
     * @param  string $message
     * @return \Vein\Core\Crud\Grid\Filter\Field
     */
    public function setErrorMessage($message)
    {
        $this->_errorMessage = (string) $message;
        return $this;
    }

    /**
     * Get error message
     *
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->_errorMessage;
    }

    /**
     * Return phalcon form element
     *
     * @return \Phalcon\Forms\Element
     */
    public function getElement()
    {
        if (!($this->_element instanceof \Phalcon\Forms\Element)) {
            $this->_createElement();
        }

        return $this->_element;
    }

    /**
     * Create phalcon from element
     *
     * @throws \Vein\Core\Exception
     * @return void
     */
    protected function _createElement()
    {
        if (!($element = $this->getFormElementClassName($this->_type))) {
            throw new \Vein\Core\Exception("Form element '{$this->_type}' not exists");
        }

        $this->_element = new $element($this->_key);
        //$this->_element->setFilters($this->getFilters());
        $this->_element->addValidators($this->getValidators());
        $this->_element->setAttributes($this->getAttribs());
        $this->_element->setLabel($this->_label);
        if (!$this->_element instanceof TextArea) {
            $this->_element->setDesc($this->_desc);
        }
        $this->_element->setDefault($this->getValue());
        $message = $this->getErrorMessage();
        if ($message) {
            $this->_element->appendMessage(new Message($message, $this->_key, $this->_type));
        }
    }

    /**
     * Return form element class name
     *
     * @param string $element
     * @return string
     */
    public function getFormElementClassName($name)
    {
        $element = '\Vein\Core\Forms\Element\\'.ucfirst($name);
        if (!class_exists($element)) {
            $element = '\Phalcon\Forms\Element\\'.ucfirst($name);
            if (!class_exists($element)) {
                return false;
            }
        }

        return $element;
    }
}