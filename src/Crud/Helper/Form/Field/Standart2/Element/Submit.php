<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Form\Field\Standart\Element;

use Vein\Core\Crud\Form as Form,
    Vein\Core\Crud\Form\Field as Field;

/**
 * Class form fields helper
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Helper
 */
class Submit extends Text
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
        $element->setAttribute('class', 'btn btn-info pull-right');

        $attributes = [];

        $width = $field->getWidth();
        $attributes['width'] = $width;

        $code = '
				
				';
        $elementCode = $field->getElement()->render($attributes);
        $code .= $elementCode;
        $code .'
        ';

        return $code;
    }
}