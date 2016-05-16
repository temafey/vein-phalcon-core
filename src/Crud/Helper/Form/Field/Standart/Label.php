<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Form\Field\Standart;

use Vein\Core\Crud\Form\Field;

/**
 * Class grid Form field label helper
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Helper
 */
class Label extends \Vein\Core\Crud\Helper
{
	/**
	 * Generates a widget to show a html grid Form
	 *
	 * @param \Vein\Core\Crud\Form\Field $Form
	 * @return string
	 */
	static public function _(Field $field)
	{
        $label = $field->getLabel();
        $code = '';
        if ($label) {
            $code = '<label class="control-label" for="'.$field->getKey().'">'. $field->getLabel().'</label>';
        }

		return $code;
	}
}