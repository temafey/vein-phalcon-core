<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Form\Field\Volt;

use Vein\Core\Crud\Form\Field;

/**
 * Class grid form field helper
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Helper
 */
class Description extends \Vein\Core\Crud\Helper
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
		
        $desc = $field->getDesc();
        if ($desc) {
            $code = '
						<span class="help-block">'.$field->getDesc().'</span>';
        }
		return $code;
	}
}