<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Form\Field\Volt;

use Vein\Core\Crud\Form\Field;

/**
 * Class grid form field label helper
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Helper
 */
class Label extends \Vein\Core\Crud\Helper
{
	/**
	 * Generates a widget to show a html grid form
	 *
	 * @param \Vein\Core\Crud\Form\Field $form
     *
     * @return string
	 */
	static public function _(Field $field)
	{
		$code = '';
		if ($field instanceof Field\Submit) {
			return $code;
		}
		
		$label = $field->getLabel();
		if ($label === '') {
			return $code;
		}
        $code .= '						<label class="col-sm-2 control-label" for="'.$field->getKey().'">'. $field->getLabel().'</label>';

		return $code;
	}
}