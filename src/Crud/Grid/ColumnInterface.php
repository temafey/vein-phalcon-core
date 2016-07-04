<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Grid;

use Vein\Core\Crud\Grid,
    Vein\Core\Crud\Container\Grid as GridContainer;
	
/**
 * Interface of grid column
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Grid
 */
interface ColumnInterface
{
	/**
	 * Render column
	 * 
	 * @param mixed $row
     *
     * @return string
	 */
	public function render($row);
	
	/**
	 * Update grid container
	 * 
	 * @param \Vein\Core\Crud\Container\Grid\Adapter $container
     *
     * @return \Vein\Core\Crud\Grid\ColumnInterface
	 */
	public function updateContainer(GridContainer\Adapter $container);
	
	/**
	 * Update container data source
	 * 
	 * @param mixed $dataSource
     *
     * @return \Vein\Core\Crud\Grid\ColumnInterface
	 */
	public function updateDataSource($dataSource);
}