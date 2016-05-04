<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Grid\Filter\Field;

use Engine\Crud\Grid\Filter\Field,
    Engine\Filter\SearchFilterInterface as Criteria,
    Engine\Crud\Container\AbstractContainer as Container;

/**
 * Grid filter field
 *
 * @category   Engine
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
        $this->_label = $label;
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
	 * @return \Engine\Filter\SearchFilterInterface
	 */
    public function getFilter() 
    {
	}

    /**
     * Apply field filter value to dataSource
     *
     * @param mixed $dataSource
     * @param \Engine\Crud\Container\AbstractContainer $container
     * @return \Engine\Crud\Grid\Filter\Field
     */
    public function applyFilter($dataSource, Container $container)
    {
    }
}
