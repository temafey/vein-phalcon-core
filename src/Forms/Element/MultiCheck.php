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
class MultiCheck extends \Vein\Core\Forms\Element\Select implements \Vein\Core\Forms\ElementInterface
{
    /**
     * Form element description
     * @var string
     */
    protected $_desc;

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

    /**
     * Render multi checkbox field
     *
     * @param array $attributes
     * 
     * @return string
     */
    public function render($attributes=null)
    {
        $html = \Vein\Core\Tag::multiCheckField($attributes);
        return $html;
    }

    /**
     * If element is need to be rendered in default layout
     *
     * @return bool
     */
    public function useDefaultLayout()
    {
        return false;
    }
}