<?php
/**
 * @namespace
 */
namespace Vein\Core\Forms\Element;

/**
 * Class Check
 *
 * @category    Vein\Core
 * @package     Forms
 * @subcategory Element
 */
class Check extends \Phalcon\Forms\Element\Check implements \Vein\Core\Forms\ElementInterface
{
    /**
     * Form element description
     * @var string
     */
    protected $_desc;

    /**
     * @param string $name
     * @param array $attributes
     */
    public function __construct($name, $attributes=null)
    {
        if (isset($attributes['value']) && $attributes['value'] == true) {
            $attributes['checked'] = 'checked';
        }

        if (isset($attributes['options'])) {
            $attributes['value'] = $attributes['options'];
            unset($attributes['options']);
        }

        parent::__construct($name, $attributes);
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
     * @return \Vein\Core\Forms\ElementInterface
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

    /**
     * Set default value
     *
     * @param mixed $value
     *
     * @return \Vein\Core\Forms\Element\Check
     */
    public function setDefault($value)
    {
        if ($value == true) {
            $this->setAttribute('checked', 'checked');
        } else {
            $attributes = $this->getAttributes();
            unset($attributes['checked']);
            $this->setAttributes($attributes);
        }

        return parent::setDefault($value);
    }

    /**
     * Prepare form element attributes
     *
     * @param array $attributes
     * @param bool $useChecked
     *
     * @return array
     */
    public function prepareAttributes($attributes = NULL, $useChecked = NULL)
    {
        if (!is_array($attributes)) {
            $attributes = [];
        }
        $attributes = array_merge(array($this->_name), $attributes);

        return array_merge($attributes, $this->getAttributes());
    }


}