<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Form\Field\Extjs;

use Vein\Core\Crud\Form\Extjs as Form,
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
     * Render extjs date form field
     *
     * @param \Vein\Core\Crud\Form\Field $field
     * @return string
     */
    public static function _(Field\Date $field)
    {
        $fieldCode = [];

        if ($field->isHidden()) {
            $fieldCode[] = "xtype: 'hiddenfield'";
        } else {
            $fieldCode[] = "xtype: 'datefield'";
        }
        if ($field->isNotEdit()) {
            $fieldCode[] = "readOnly: true";
        }
        $fieldCode[] = "name: '".$field->getKey()."'";
        $fieldCode[] = "allowBlank: ".(($field->isRequire()) ? "false" : "true");

        $label = $field->getLabel();
        if ($label) {
            $fieldCode[] = "fieldLabel: '".$label."'";
        }
        $desc = $field->getDesc();
        if ($desc) {
            $fieldCode[] = "boxLabel: '".$desc."'";
        }
        $width = $field->getWidth();
        if ($width) {
            $fieldCode[] = "width: ".$width;
        }

        $format = $field->getFormat();
        $minValue = $field->getMinValue();
        $maxValue = $field->getMaxValue();
        $disabledDays = false;
        $disabledDaysText = false;

        $fieldCode[] = "format: '".$format."'";
        if ($minValue !== null && $minValue !== false) {
            $fieldCode[] = "minValue: '".$minValue."'";
        }
        if ($maxValue !== null && $maxValue !== false) {
            $fieldCode[] = "maxValue: '".$maxValue."'";
        }
        if ($disabledDays !== null && $disabledDays !== false) {
            $fieldCode[] = "disabledDays: '".$disabledDays."'";
        }
        if ($disabledDaysText !== null && $disabledDaysText !== false) {
            $fieldCode[] = "disabledDaysText: '".$disabledDaysText."'";
        }

        return forward_static_call(['self', '_implode'], $fieldCode);
    }
}