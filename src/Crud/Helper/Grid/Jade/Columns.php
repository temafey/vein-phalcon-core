<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Grid\Jade;

use Vein\Core\Crud\Grid,
    Vein\Core\Crud\Grid\Column;

/**
 * Class grid columns helper
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Helper
 */
class Columns extends \Vein\Core\Crud\Helper
{
	/**
	 * Generates grid table colums head
	 *
	 * @param \Vein\Core\Crud\Grid $grid
	 * @return string
	 */
	static public function _(Grid $grid)
	{
        $code = '
            thead
                tr';

        foreach ($grid->getColumns() as $column) {
            if ($column instanceof Column) {
                $columnCode = '
                th(style=\'width: '.$column->getWidth().') ';
                if ($column->isHidden()) {
                    $columnCode .= '';
                } else {
                    $columnCode .= $column->getTitle();
                }
            } else {
                $columnCode = '
                th';
            }
            $code .= $columnCode;
        }

        return $code;
	}

    /**
     * Create column sortable link
     *
     * @param \Vein\Core\Crud\Grid\Column $column
     * @return string
     */
    static public function sortLink(Column $column)
    {
        $grid = $column->getGrid();
        $action = $grid->getAction();
        $sortDirection = $column->getSortDirection();
        $sorted = $column->isSorted();
        $params = $column->getSortParams();
        if ($action) {
            $action = '/'.$action.'/?'.http_build_query($params);
        } else {
            $action = '?'.http_build_query($params);
        }
        $link = '';
        $sortIcon = '';
        if ($sorted) {
            $link .= '<b>';
            $sortIcon = ($sortDirection == "asc") ? "/\\" : "\\/";
        }
        $link .= '<a href="'.$action.'">'.$column->getTitle()." ".$sortIcon."</a>";
        if ($sorted) {
            $link .= '</b>';
        }

        return $link;
    }
}