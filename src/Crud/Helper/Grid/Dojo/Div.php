<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Grid\Dojo;

/**
 * Class dojo div helper
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Helper
 */
class Div extends \Vein\Core\Crud\Helper
{
    /**
     * Generates a widget to show a dojo grid layout
     *
     * @param \Vein\Core\Crud\Grid $grid
     * @return string
     */
    static public function _(\Vein\Core\Crud\Grid $grid)
    {
        $gridDivId = 'gridDiv_'.$grid->getId();
        $code = '
		<div id="'.$gridDivId.'"></div>
		';

        return $code;
    }
}