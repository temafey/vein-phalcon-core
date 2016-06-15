<?php
/**
 * @namespace
 */
namespace Vein\Core\Forms\Element;

/**
 * Class Radio
 *
 * @category    Vein\Core
 * @package     Forms
 * @subcategory Element
 */
class Radio extends \Phalcon\Forms\Element\Radio implements \Vein\Core\Forms\ElementInterface
{
    /**
     * Form element description
     * @var string
     */
    protected $_desc;

    /**
     * @param string $name
     * @param array $options
     * @param aray $attributes
     */
    public function __construct($name, $options = null, $attributes = null)
    {
        $optionsData = (!empty($options['options']) ? $options['options'] : null);
        unset($options['options']);
        if (!is_array($attributes)) {
            $attributes = [];
        }
        $options = array_merge($options, $attributes);
        parent::__construct($name, $optionsData, $options);
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
     * @return \Vein\Core\Forms\Element\Radio
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
     * Render form element
     *
     * @param array|string $attributes
     * @return string
     * @throws \Vein\Core\Exception
     * @return string
     */
    public function render($attributes = null)
    {
        $content = '';
        $options = $this->getOptions();
        $attributes = $this->getAttributes();;
        $value = (isset($attributes['value']) ? $attributes['value'] : null);

        if (is_array($options)) {
            foreach ($options as $key => $option) {
                $content .= sprintf('<div class="form_element_radio"><input type="radio" value="%s" %s name="url_type" id="url_type"><label>%s</label></div>',
                    $key,
                    ($key == $value ? 'checked="checked"' : ''),
                    $option
                );
            }
        } else {
            if (!isset($attributes['using']) || !is_array($attributes['using']) || count($attributes['using']) != 2)
                throw new \Vein\Core\Exception("The 'using' parameter is required to be an array with 2 values.");
            $keyAttribute = array_shift($attributes['using']);
            $valueAttribute = array_shift($attributes['using']);
            foreach ($options as $option) {
                /** @var \Phalcon\Mvc\Model $option */
                $optionKey = $option->readAttribute($keyAttribute);
                $optionValue = $option->readAttribute($valueAttribute);
                $content .= sprintf('<div class="form_element_radio"><input type="radio" value="%s" %s name="url_type" id="url_type"><label>%s</label></div>',
                    $optionKey,
                    ($optionKey == $value ? 'checked="checked"' : ''),
                    $optionValue
                );
            }
        }

        return $content;
    }
}