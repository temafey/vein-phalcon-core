<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Grid\DataTable;

/**
 * Class html grid helper
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Helper
 */
class Filter extends BaseHelper
{
	/**
	 * Generates a widget to show a html grid
	 *
	 * @param \Vein\Core\Crud\Grid $grid
	 * @return string
	 */
	static public function _(\Vein\Core\Crud\Grid $grid)
	{
        $filter = $grid->getFilter();
        $filter->render();

        return '';
	}
}