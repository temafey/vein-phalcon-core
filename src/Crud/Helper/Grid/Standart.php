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
        $code = '<div class="box">
	<div class="box-header">
		<h3 class="box-title">'.$grid->getTitle().'</h3>
	</div>
	<div class="box-body">
		<table id="'.$grid->getId().'" autowidth="true" class="'.$grid->getAttrib('class').' table table-bordered table-hover">
	';

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
        </table>
	</div>
</div>';
    }
}