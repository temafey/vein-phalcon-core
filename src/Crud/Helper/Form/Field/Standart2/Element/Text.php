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
class Text extends BaseHelper
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
        $attributes = [];

        $width = $field->getWidth();
        $attributes['width'] = $width;

        $code = '
                        ';
        $elementCode = $field->getElement()->render($attributes);
        $code .= $elementCode;

        return $code;
    }
}