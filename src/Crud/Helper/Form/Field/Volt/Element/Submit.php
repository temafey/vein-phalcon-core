<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Form\Field\Volt\Element;

use Vein\Core\Crud\Grid\Filter as Filter,
    Vein\Core\Crud\Form\Field as Field;

/**
 * Class form fields helper
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Helper
 */
class Submit extends Standart
{
    /**
     * Render text form field
     *
     * @param \Vein\Core\Crud\Form\Field $field
     *
     * @return string
     */
    public static function _(Field $field)
    {
        $element = $field->getElement();

        $element->setAttribute('class', 'btn btn-info pull-left');

        $width = $field->getWidth();
        $element->setAttribute('width', $width);

        return $element->render();
    }
}