<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Grid\Standart;

use Vein\Core\Crud\Grid;

/**
 * Class grid datastore helper
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Helper
 */
class Body extends BaseHelper
{
	/**
	 * Generates grid table rows
	 *
	 * @param \Vein\Core\Crud\Grid $grid
	 * @return string
	 */
	static public function _(Grid $grid)
	{
        $code = '
		    	<tbody>
		    	</tbody>';

        return $code;
	}
}