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
class Standart extends \Vein\Core\Crud\Helper
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
        <h1>'.$grid->getTitle().'</h1>
        <table id="'.$grid->getId().'" autowidth="true" class="'.$grid->getAttrib('class').' table table-bordered table-hover">';

		return $code;
	}

    /**
     * Crud helper end tag
     *
     * @return string
     */
    static public function endTag()
    {
        return '
        </table>';
    }
}