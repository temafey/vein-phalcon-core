<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Grid\Filter\Field;

use Vein\Core\Crud\Grid\Filter\Field,
    Vein\Core\Filter\SearchFilterInterface as Criteria,
    Vein\Core\Crud\Container\AbstractContainer as Container;

/**
 * Grid filter field
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Grid
 */
class Submit extends Field
{
	protected $_type = 'submit';
	
	/**
     * Constructor
	 *
	 * @param string $title
	 * @param int $width
	 */
	public function __construct($label = null, $width = 280)
	{
        $this->_value = $label;
        $this->_width = intval($width);
	}

	/**
     * Initialize field (used by extending classes)
     *
     * @return void
     */
	protected function _init()
	{
	}
	
	/**
	 * Return datasource filters
	 * 
	 * @return \Vein\Core\Filter\SearchFilterInterface
	 */
    public function getFilter() 
    {
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
    }
}
