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
class Numeric extends BaseHelper
{
    /**
     * Render number form field
     *
     * @param \Vein\Core\Crud\Form\Field $field
     *
     * @return string
     */
    public static function _(Field\Numeric $field)
    {
        $attributes = [];

        $attributes['type'] = 'number';

        $width = $field->getWidth();
        $attributes['width'] = $width;

        $minValue = $field->getMinValue();
        $maxValue = $field->getMaxValue();

        if ($minValue !== null && $minValue !== false) {
            $attributes['min'] = $minValue;
        }
        if ($maxValue !== null && $maxValue !== false) {
            $attributes['max'] = $minValue;
        }

        return $field->getElement()->render($attributes);
    }
}