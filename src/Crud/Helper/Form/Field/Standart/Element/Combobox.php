<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Form\Field\Standart\Element;

use Vein\Core\Crud\Grid\Filter as Filter,
    Vein\Core\Crud\Form\Field as Field;

/**
 * Class form fields helper
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Helper
 */
class Combobox extends BaseHelper
{
    /**
     * Render combobox form field
     *
     * @param \Vein\Core\Crud\Form\Field $field
     *
     * @return string
     */
    public static function _(Field\ArrayToSelect $field)
    {
        $element = $field->getElement();

        $width = $field->getWidth();
        $element->setAttribute('width', $width);

        return $element->render();
    }
}