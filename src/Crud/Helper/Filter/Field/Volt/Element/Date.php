<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Filter\Field\Volt\Element;

use Vein\Core\Crud\Grid\Filter as Filter,
    Vein\Core\Crud\Grid\Filter\Field as Field;

/**
 * Class filter fields helper
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Helper
 */
class Date extends BaseHelper
{
    /**
     * Render date filter field
     *
     * @param \Vein\Core\Crud\Grid\Filter\Field $field
     *
     * @return string
     */
    public static function _(Field\Date $field)
    {
        $element = $field->getElement();
        
        //$element->setAttribute('type', 'datetime');
        $element->setAttribute('type', 'date');

        $width = $field->getWidth();
        $element->setAttribute('width', $width);

        $disabledDays = false;
        $disabledDaysText = false;
        
        if ($disabledDays !== null && $disabledDays !== false) {
            $element->setAttribute('type', 'month');
        }
        if ($disabledDaysText !== null && $disabledDaysText !== false) {
            $fieldCode[] = "disabledDaysText: '".$disabledDaysText."'";
        }

        $code = '
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        ';

        $elementCode = $element->render();

        $code .= $elementCode;

        return $code;
    }
}