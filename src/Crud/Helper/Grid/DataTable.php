<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Grid;

use Vein\Core\Crud\Helper\Grid\DataTable\BaseHelper,
    Vein\Core\Crud\Grid\DataTable as Grid;

/**
 * Class html grid helper
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Helper
 */
class DataTable extends BaseHelper
{
    /**
     * Is create js file prototype
     * @var boolean
     */
    protected static $_createJs = true;

	/**
	 * Generates a widget to show a html grid
	 *
	 * @param \Vein\Core\Crud\Grid\DataTable $grid
     *
     * @return string
	 */
	static public function _(Grid $grid)
	{
        $code = '
        $(\'#'.static::getName().'\').DataTable( {
            dom: \'<"top"Bfr<"clear">>rt<"bottom"ilp<"clear">>\',
			lengthChange: true,
			processing: true,
            serverSide: true,
			paging: true,
			info: true,
			scrollX: true,
            ajax: "'.$grid->getAction().'",';

		return $code;
	}

    /**
     * Return object name
     *
     * @return string
     */
    public static function getName()
    {
        return static::getGridName();
    }

    /**
     * Crud helper end tag
     *
     * @return string
     */
    static public function endTag()
    {
        $code = '
        });';

        return $code;
    }
}