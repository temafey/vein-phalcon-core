<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Filter\Field\Standart;

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
	 * @return string
	 */
	static public function _(Field $field)
	{
		$code = 'label.col-sm-2.control-label(for=\''.$field->getKey().'\') '. $field->getLabel();

		return $code;
	}
}