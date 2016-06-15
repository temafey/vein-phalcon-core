<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Grid\Jade;

use Vein\Core\Crud\Grid;

/**
 * Class grid datastore helper
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Helper
 */
class Datastore extends \Vein\Core\Crud\Helper
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
            <tbody>';
        $columns = array_keys($grid->getColumns());
        $data = $grid->getDataWithRenderValues();
        foreach ($data['data'] as $row) {
            $rowCode = '
                <tr>';
            foreach ($columns as $key) {
                $rowCode .= '
                    <td>'.$row[$key].'</td>';
            }
            $rowCode .= '
                </tr>';
            $code .= $rowCode;
        }

        $code .= '
        </tbody>';

        return $code;
	}
}