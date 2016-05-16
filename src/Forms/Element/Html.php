<?php
/**
 * @namespace
 */
namespace Vein\Core\Forms\Element;

/**
 * Class Html
 *
 * @category    Vein\Core
 * @package     Forms
 * @subcategory Element
 */
class Html extends \Vein\Core\Forms\Element\Text implements \Vein\Core\Forms\ElementInterface
{
    /**
     * Form element description
     * @var string
     */
    protected $_html = '';

    /**
     * If element is need to be rendered in default layout
     *
     * @return bool
     */
    public function useDefaultLayout() {
        return false;
    }

    /**
     * @param string $name
     * @param array $attributes
     */
    public function __construct($name, $attributes=null)
    {
        if (isset($attributes['html']) ) {
            $this->_html = $attributes['html'];
            unset($attributes['html']);
        }

        parent::__construct($name, $attributes);
    }

    public function render($attributes = null)
    {
        return $this->_html;
    }
}