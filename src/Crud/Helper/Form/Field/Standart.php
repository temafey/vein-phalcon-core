<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Form\Field;

use Vein\Core\Crud\Form\Field;

/**
 * Class form field helper
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Helper
 */
class Standart extends \Vein\Core\Crud\Helper
{
	/**
	 * Generates a widget to show a html grid filter
	 *
	 * @param \Vein\Core\Crud\Form\Field $filter
	 * @return string
	 */
	static public function _(Field $field)
	{
        $code = '<div class="control-group">';

		return $code;
	}

    /**
     * Crud helper end tag
     *
     * @return string
     */
    static public function endTag()
    {
        return '</div>';
    }
}