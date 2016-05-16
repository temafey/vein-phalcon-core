<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Grid\Column;

use Vein\Core\Crud\Grid\Column,
    Vein\Core\Crud\Grid,
    Vein\Core\Crud\Container\Grid as GridContainer,
    Phalcon\Filter;

/**
 * Class Base
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Grid
 */
class Base extends Column
{
    /**
     * Update grid container
     *
     * @param \Vein\Core\Crud\Container\Grid\Adapter $container
     * @return \Vein\Core\Crud\Grid\Column
     */
    public function updateContainer(\Vein\Core\Crud\Container\Grid\Adapter $container)
    {
        $container->setColumn($this->_key, $this->_name, $this->_useTableAlias, $this->_useCorrelationTableName);
        return $this;
    }

    /**
     * Return render value
     * (non-PHPdoc)
     * @see \Vein\Core\Crud\Grid\Column::render()
     * @param mixed $row
     * @return string
     */
    public function render($row)
    {
        $key = ($this->_useColumNameForKey) ? $this->_name : $this->_key;
        if (array_key_exists($key, $row)) {
            $value = $row[$key];
        } else {
            if ($this->_strict) {
                throw new \Vein\Core\Exception("Key '{$key}' not exists in grid data row!");
            } else{
                return null;
            }
        }

        $value = $this->filter($value);

        return $value;
    }

}