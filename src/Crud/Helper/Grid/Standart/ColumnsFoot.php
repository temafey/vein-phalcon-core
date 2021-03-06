<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Grid\Standart;

use Vein\Core\Crud\Grid,
    Vein\Core\Crud\Grid\Column;

/**
 * Class grid columns helper
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Helper
 */
class ColumnsFoot extends BaseHelper
{
	/**
	 * Generates grid table colums head
	 *
	 * @param \Vein\Core\Crud\Grid $grid
     *
     * @return string
	 */
	static public function _(Grid $grid)
	{
        $code = '
		        <tfoot>
		            <tr></tr>';

        foreach ($grid->getColumns() as $column) {
            if ($column instanceof Column) {
                /*$columnCode = '
                            th(style=\'width: '.$column->getWidth().') ';*/
                $columnCode = '
		                <th>';
                if ($column->isHidden()) {
                    $columnCode .= '';
                } else {
                    $columnCode .= $column->getTitle();
                }
            } else {
                $columnCode = '
		                <th>';
            }
            $code .= $columnCode.'</th>';
        }

        return $code;
	}
}