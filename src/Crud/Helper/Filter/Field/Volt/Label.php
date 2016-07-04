<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Filter\Field\Volt;

use Vein\Core\Crud\Grid\Filter\Field;

/**
 * Class grid filter field label helper
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Helper
 */
class Label extends \Vein\Core\Crud\Helper
{
	/**
	 * Generates a widget to show a html grid filter
	 *
	 * @param \Vein\Core\Crud\Grid\Filter\Field $filter
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
        $code .= '						<label for="'.$field->getKey().'">'. $field->getLabel().'</label>';

		return $code;
	}
}