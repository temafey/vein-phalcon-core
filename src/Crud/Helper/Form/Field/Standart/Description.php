<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Form\Field\Standart;

use Vein\Core\Crud\Form\Field;

/**
 * Class grid Form field helper
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Helper
 */
class Description extends \Vein\Core\Crud\Helper
{
	/**
	 * Generates a widget to show a html grid Form
	 *
	 * @param \Vein\Core\Crud\Form\Field $Form
	 * @return string
	 */
	static public function _(Field $field)
	{
        $desc = $field->getDesc();
        $code = '';
        if ($desc) {
            $code = '<span>'.$field->getDesc().'</span>';
        }

		return $code;
	}
}