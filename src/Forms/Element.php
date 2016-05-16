<?php
/**
 * @namespace
 */
namespace Vein\Core\Forms;

/**
 * Class Element
 *
 * @category    Vein\Core
 * @package     Forms
 */
abstract class Element extends \Phalcon\Forms\Element implements ElementInterface
{

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
     * @return \Vein\Core\Forms\Element
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