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
class Jade extends \Vein\Core\Crud\Helper
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
        .box
			.box-header
				h3.box-title '.$grid->getTitle().'
			.box-body
    			table#'.$grid->getId().'.table.table-bordered.table-striped.'.$grid->getAttrib('class');

		return $code;
	}

    /**
     * Crud helper end tag
     *
     * @return string
     */
    static public function endTag()
    {
        return '';
    }
}