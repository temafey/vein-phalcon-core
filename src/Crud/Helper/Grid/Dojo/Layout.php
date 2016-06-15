<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Grid\Dojo;

/**
 * Class dojo layuot helper
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Helper
 */
class Layout extends \Vein\Core\Crud\Helper
{
    /**
     * Generates a widget to show a dojo grid layout
     *
     * @param \Vein\Core\Crud\Grid $grid
     * @return string
     */
    static public function _(\Vein\Core\Crud\Grid $grid)
    {
        $code = '
        /*set up layout*/
        var layout = [
        ';

        $columns = [];
        foreach ($grid->getColumns() as $column) {
            $columnData = [];
            if ($column instanceof \Vein\Core\Crud\Grid\Column) {
                $columnData['name'] = $column->getTitle();
                $columnData['field'] = $column->getKey();
                $columnData['width'] = $column->getWidth()."px";
            }
            $columns[] = $columnData;
        }

        $code .= json_encode($columns);
        $code .= '
        ];';

        return $code;
    }
}