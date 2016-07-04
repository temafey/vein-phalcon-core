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
        $element = $field->getElement();

        //$element->setAttribute('type', 'datetime');
        $element->setAttribute('type', 'date');
        $element->setAttribute('id', 'datepicker');

        $width = $field->getWidth();
        $element->setAttribute('width', $width);

        //$format = $field->getFormat();
        $disabledDays = false;
        $disabledDaysText = false;
        
        if ($disabledDays !== null && $disabledDays !== false) {
            $element->setAttribute('type', 'month');
        }

        $code = '
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        ';

        $elementCode = $element->render();

        $code .= $elementCode;
        $code .= '
                    </div>';

        return $code;
    }
}