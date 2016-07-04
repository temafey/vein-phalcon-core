<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Filter\Extjs;

use Vein\Core\Crud\Grid\Filter;

/**
 * Class form functions helper
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Helper
 */
class Functions extends BaseHelper
{
	/**
	 * Generates form functions object
	 *
	 * @param \Vein\Core\Crud\Grid\Filter $filter
     *
     * @return string
	 */
	static public function _(Filter $filter)
	{
        $url = $filter->getAction()."/read";

        $code = "

            tbarGet: function() {
                return[
                ]
            },

            bbarGet: function() {
                return [
                ]
            },
            ";

        return $code;
	}
}