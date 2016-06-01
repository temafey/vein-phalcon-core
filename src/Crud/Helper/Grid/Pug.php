<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Grid;

use Vein\Core\Crud\Helper\Grid\Pug\BaseHelper,
	Vein\Core\Crud\Grid\DataTable as Grid;

/**
 * Class html grid helper
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Helper
 */
class Pug extends BaseHelper
{
	/**
	 * Generates a widget to show a html grid
	 *
	 * @param \Vein\Core\Crud\Grid\DataTable $grid
	 * @return string
	 */
	static public function _(Grid $grid)
	{
        $code = '.box
	.box-header
		h3.box-title '.$grid->getTitle().'
	.box-body
		table#'.static::getGridName().'.table.table-bordered.table-striped.'.$grid->getAttrib('class');

		return $code;
	}

    /**
     * Crud helper end tag
     *
     * @return string
     */
    static public function endTag()
    {
        return ' ';
    }
}