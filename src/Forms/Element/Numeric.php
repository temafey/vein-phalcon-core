<?php
/**
 * @namespace
 */
namespace Vein\Core\Forms\Element;

/**
 * Class Numeric
 *
 * @category    Engine
 * @package     Forms
 * @subcategory Element
 */
class Numeric extends \Phalcon\Forms\Element\Numeric implements \Engine\Forms\ElementInterface
{
    /**
     * Form element description
     * @var string
     */
    protected $_desc;

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
     * @return \Engine\Forms\Element\Text
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