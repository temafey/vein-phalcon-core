<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Filter\Field\Standart;

use Vein\Core\Crud\Grid\Filter\Field;

/**
 * Class grid filter field helper
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Helper
 */
class Element extends \Vein\Core\Crud\Helper
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
			return self::renderField($field);
		}

		$element = $field->getElement();

		if (!$field instanceof Field\Checkbox) {
			$element->setAttribute('class', 'form-control');
		}
		$element->setAttribute('id', $field->getKey());
		$element->setAttribute('placeholder', $field->getLabel());

		$code = '
				<div class="input-group">';

		$code .= self::renderField($field);

		$code .= '
				</div>';

		return $code;
	}

	/**
	 * Render filter form field
	 *
	 * @param \Vein\Core\Crud\Grid\Filter\Field $field
	 *
	 * @return string
	 */
	public static function renderField(\Vein\Core\Crud\Grid\Filter\Field $field)
	{
		$helperName = self::getFieldHelper($field);
		$helper = \Vein\Core\Crud\Decorator\Helper::factory($helperName, $field);

		$elementContent = call_user_func_array([$helper['helper'], '_'], [$helper['element']]);
		$elementContent .= call_user_func([$helper['helper'], 'endTag']);

		return $elementContent;
	}

	/**
	 * Return form field helper name
	 *
	 * @param \Vein\Core\Crud\Grid\Filter\Field $field
	 *
	 * @return string
	 */
	public static function getFieldHelper(\Vein\Core\Crud\Grid\Filter\Field $field)
	{
		$reflection = new \ReflectionClass(get_class($field));
		$name = $reflection->getShortName();

		return 'standart\Element\\'.$name;
	}
}