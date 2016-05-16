<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Grid;

/**
 * Class html grid helper
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Helper
 */
class Dojo extends \Vein\Core\Crud\Helper
{
	/**
	 * Generates a widget to show a html grid
	 *
	 * @param \Vein\Core\Crud\Grid $grid
	 * @return string
	 */
	static public function _(\Vein\Core\Crud\Grid $grid)
	{
        $code = '
    require([\'dojo/_base/lang\', \'dojox/grid/DataGrid\', \'dojo/data/ItemFileWriteStore\', \'dojo/dom\', \'dojo/domReady!\'],
    function(lang, DataGrid, ItemFileWriteStore, dom) {
    ';
        $gridDivId = 'gridDiv_'.$grid->getId();
        $code .= '
        /*create a new grid*/
        var grid = new DataGrid({
            id: \''.$grid->getId().'\',
            store: store,
            structure: layout,
            rowSelector: \'20px\'
        });

        /*append the new grid to the div*/
        grid.placeAt("'.$gridDivId.'");

        /*Call startup() to render the grid*/
        grid.startup();
    });';

		return '<script>'.$code;
	}

    /**
     * Crud helper end tag
     *
     * @return string
     */
    static public function endTag()
    {
        return '
</script>';
    }
}