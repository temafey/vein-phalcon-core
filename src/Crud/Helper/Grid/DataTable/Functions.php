<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Grid\DataTable;

use Vein\Core\Crud\Grid\DataTable as Grid;

/**
 * Class grid functions helper
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Helper
 */
class Functions extends BaseHelper
{
	/**
	 * Generates grid functions object
	 *
	 * @param \Vein\Core\Crud\Grid\DataTable $grid
	 * @return string
	 */
	static public function _(Grid $grid)
	{
        $code = '
            select: true,
        ';

        return $code;
	}
}