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
class Element extends \Vein\Core\Crud\Helper
{
	/**
	 * Generates a widget to show a html grid Form
	 *
	 * @param \Vein\Core\Crud\Form\Field $field
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
				    <div class="input-group">
				        ';

        $code .= self::renderField($field);

        $code .= '
				    </div>';

        return $code;
	}

    /**
     * Render form form field
     *
     * @param \Vein\Core\Crud\Form\Field $field
     *
     * @return string
     */
    public static function renderField(\Vein\Core\Crud\Form\Field $field)
    {
        $helperName = self::getFieldHelper($field);
        $helper = \Vein\Core\Crud\Decorator\Helper::factory($helperName, $field);

        $code ='
                <div class="col-sm-10">';

        $elementContent = call_user_func_array([$helper['helper'], '_'], [$helper['element']]);
        $elementContent .= call_user_func([$helper['helper'], 'endTag'], [$helper['element']]);

        $code .= $elementContent;

        $code .= '
                </div>';

        return $code;
    }

    /**
     * Return form field helper name
     *
     * @param \Vein\Core\Crud\Form\Field $field
     *
     * @return string
     */
    public static function getFieldHelper(\Vein\Core\Crud\Form\Field $field)
    {
        $reflection = new \ReflectionClass(get_class($field));
        $name = $reflection->getShortName();

        return 'standart\Element\\'.$name;
    }
}