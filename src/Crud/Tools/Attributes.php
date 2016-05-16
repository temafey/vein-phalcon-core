<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Tools;

/**
 * Trait Attributes
 *
 * @category    Vein\Core
 * @package     Crud
 * @subcategory Tools
 */
trait Attributes
{
    /**
     * Element attributes
     * @var array
     */
    protected $_attribs = [];

    /**
     * Return element attributes
     *
     * @return array
     */
    public function getAttribs()
    {
        return $this->_attribs;
    }

    /**
     * Return element attribute
     *
     * @param string $name
     * @return string
     */
    public function getAttrib($name)
    {
        if (!isset($this->_attribs[$name])) {
            return false;
        }
        return $this->_attribs[$name];
    }

    /**
     * Set element attributes
     *
     * @param array $attribs
     * @return \Vein\Core\Crud\Tools\Attributes
     */
    public function setAttribs(array $attribs)
    {
        $this->clearAttribs();
        foreach ($attribs as $key => $value) {
            $this->setAttrib($key, $value);
        }

        return $this;
    }

    /**
     * Set element attributes
     *
     * @param array $attribs
     * @return \Vein\Core\Crud\Tools\Attributes
     */
    public function addAttribs(array $attribs)
    {
        foreach ($attribs as $key => $value) {
            $this->setAttrib($key, $value);
        }

        return $this;
    }

    /**
     * Add element attribute
     *
     * @param string $key
     * @param string $value
     * @return \Vein\Core\Crud\Tools\Attributes
     */
    public function setAttrib($key, $value = null)
    {
        $this->_attribs[$key] = $value;
        return $this;
    }

    /**
     * Remove element attribute
     *
     * @param string $key
     * @return \Vein\Core\Crud\Tools\Attributes
     */
    public function removeAttrib($key)
    {
        unset($this->_attribs[$key]);
        return $this;
    }

    /**
     * Clear element attributes
     *
     * @return \Vein\Core\Crud\Tools\Attributes
     */
    public function clearAttribs()
    {
        $this->_attribs = [];
        return $this;
    }
}