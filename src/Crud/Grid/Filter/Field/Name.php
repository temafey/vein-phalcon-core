<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Grid\Filter\Field;

use Vein\Core\Filter\SearchFilterInterface as Criteria,
    Vein\Core\Crud\Container\AbstractContainer as Container;

/**
 * Grid filter field
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Grid
 */
class Name extends Standart
{
    /**
     * Constructor
     *
     * @param string $title
     * @param string $desc
     * @param string $criteria
     * @param int $width
     */
    public function __construct(
        $label = null,
        $desc = null,
        $criteria = Criteria::CRITERIA_BEGINS,
        $width = 280,
        $defaultValue = false,
        $length = 100)
    {
        $this->_label = $label;
        $this->_desc = $desc;
        $this->_criteria = $criteria;
        $this->_width = intval($width);
        $this->_default = $defaultValue;
        $this->_length = intval($length);
    }

    /**
     * Initialize field (used by extending classes)
     *
     * @return void
     */
    protected function _init()
    {
        $this->_filters[] = [
            'filter' => 'trim',
            'options' => []
        ];
    }

    /**
     * Apply field filter value to dataSource
     *
     * @param mixed $dataSource
     * @param \Vein\Core\Crud\Container\AbstractContainer $container
     *
     * @return \Vein\Core\Crud\Grid\Filter\Field
     */
    public function applyFilter($dataSource, Container $container)
    {
        $model = $dataSource->getModel();
        $this->_name = $model->getNameExpr();

        return parent::applyFilter($dataSource, $container);
    }


}
