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
        $element = $field->getElement();
        if ($field instanceof Field\Submit) {
            $element->setAttribute('class', 'btn');
        }
        $element->setAttribute('id', $field->getKey());
        $element->setAttribute('placeholder', $field->getLabel());
        $code = '<div class="controls">';
        $code .= $element->render();
        $code .= "</div>";

		return $code;
	}
}