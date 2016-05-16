<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Form\Extjs;

use Vein\Core\Crud\Form\Extjs as Form;

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
	 * @param \Vein\Core\Crud\Form\Extjs $form
	 * @return string
	 */
	static public function _(Form $form)
	{
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