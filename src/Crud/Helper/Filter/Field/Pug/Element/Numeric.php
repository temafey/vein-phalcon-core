<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Filter\Field\Pug\Element;

use Vein\Core\Crud\Grid\Filter as Filter,
    Vein\Core\Crud\Grid\Filter\Field as Field;

/**
 * Class filter fields helper
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Helper
 */
class Numeric extends BaseHelper
{
    /**
     * Render extjs number filter field
     *
     * @param \Vein\Core\Crud\Grid\Filter\Field $field
     * @return string
     */
    public static function _(Field\Numeric $field)
    {
        $fieldCode = [];

        $fieldCode[] = "xtype: 'numberfield'";
        $fieldCode[] = "name: '".$field->getKey()."'";

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

        $minValue = $field->getMinValue();
        $maxValue = $field->getMaxValue();

        if ($minValue !== null && $minValue !== false) {
            $fieldCode[] = " minValue: '".$minValue."'";
        }
        if ($maxValue !== null && $maxValue !== false) {
            $fieldCode[] = " maxValue: '".$maxValue."'";
        }

        return forward_static_call(['self', '_implode'], $fieldCode);
    }
}