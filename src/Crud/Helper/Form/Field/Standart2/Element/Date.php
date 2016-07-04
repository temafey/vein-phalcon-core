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
class Date extends BaseHelper
{
    /**
     * Render date form field
     *
     * @param \Vein\Core\Crud\Form\Field $field
     *
     * @return string
     */
    public static function _(Field\Date $field)
    {
        $attributes = [];

        $attributes['type'] = 'datetime';
        $attributes['type'] = 'date';

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

        $format = $field->getFormat();
        $disabledDays = false;
        $disabledDaysText = false;
        
        if ($disabledDays !== null && $disabledDays !== false) {
            $attributes['type'] = 'month';
        }
        if ($disabledDaysText !== null && $disabledDaysText !== false) {
            $fieldCode[] = "disabledDaysText: '".$disabledDaysText."'";
        }

        $code = '
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        ';

        $elementCode = $field->getElement()->render($attributes);

        $code .= $elementCode;

        return $code;
    }
}