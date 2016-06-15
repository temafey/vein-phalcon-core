<?php
/**
 * @namespace
 */
namespace Vein\Core\Forms\Element;

/**
 * Class Select
 *
 * @category    Vein\Core
 * @package     Forms
 * @subcategory Element
 */
class Select extends \Phalcon\Forms\Element\Select implements \Vein\Core\Forms\ElementInterface
{
    protected $_value;

    /**
     * @param string $name
     * @param array $options
     * @param array $attributes
     */
    public function __construct($name, $options=null, $attributes=null)
    {
        if (!is_array($options)) {
            $options = [];
        }
        $optionsData = (!empty($options['options']) ? $options['options'] : null);
        unset($options['options']);
        if (!is_array($attributes)) {
            $attributes = [];
        }
        $options = array_merge($options, $attributes);

        parent::__construct($name, $optionsData, $options);
    }

    public function setDefault($value)
    {
        $this->_value = $value;
    }

    /**
     * Return element value
     *
     * @return integer
     */
    public function getValue()
    {
        return $this->_value;
    }

    /**
     * If element is need to be rendered in default layout
     *
     * @return bool
     */
    public function useDefaultLayout()
    {
        return true;
    }

    /**
     * Sets the element description
     *
     * @param string $desc
     * 
     * @return \Vein\Core\Forms\Element\Select
     */
    public function setDesc($desc)
    {
        $this->_desc = $desc;
        return $this;
    }

    /**
     * Returns the element's description
     *
     * @return string
     */
    public function getDesc()
    {
        return $this->_desc;
    }
}