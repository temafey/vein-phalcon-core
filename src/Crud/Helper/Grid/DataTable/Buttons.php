<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Grid\DataTable;

use Vein\Core\Crud\Grid\DataTable as Grid;

/**
 * Class form functions helper
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Helper
 */
class Buttons extends BaseHelper
{
	/**
	 * Generates grid buttons objects
	 *
	 * @param \Vein\Core\Crud\Grid\DataTable $grid
	 * @return string
	 */
	static public function _(Grid $grid)
	{
        $primary = $grid->getPrimaryColumn();
		$formId = static::getFormName();

        $code = '
            buttons: [
				{ extend: \'create\', editor: '.$formId.' },
				{ extend: \'edit\',   editor: '.$formId.' },
				{ extend: \'remove\', editor: '.$formId.' }
        	]';

        return $code;
	}
}