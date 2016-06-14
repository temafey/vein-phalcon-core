<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Grid\Filter;

use Vein\Core\Crud\Grid\Filter;

/**
 * Class filter grid.
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Grid
 */
class DataTable extends Filter
{
    /**
     * Initialize decorator
     *
     * @return void
     */
    protected function _initDecorator()
    {
        $this->_decorator = 'DataTable';
    }

    /**
     * Get grid action
     *
     * @return string
     */
    public function getModulePrefix()
    {
        return $this->_grid->getModulePrefix();
    }

    /**
     * Return DataTable module name
     *
     * @return string
     */
    public function getModuleName()
    {
        return $this->_grid->getModuleName();
    }

    /**
     * Return DataTable grid key
     *
     * @return string
     */
    public function getKey()
    {
        return $this->_grid->getKey();
    }

    /**
     * Get grid action
     *
     * @return string
     */
    public function getAction()
    {
        return $this->_grid->getAction();
    }
}