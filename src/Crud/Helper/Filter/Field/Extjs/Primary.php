<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Filter\Field\Extjs;

use Vein\Core\Crud\Grid\Filter as Filter,
    Vein\Core\Crud\Grid\Filter\Field as Field;

/**
 * Class filter fields helper
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Helper
 */
class Primary extends BaseHelper
{
    /**
     * Render extjs primary filter field
     *
     * @param \Vein\Core\Crud\Grid\Filter\Field $field
     * @return string
     */
    public static function _(Field $field)
    {
        $fieldCode = [];

        $fieldCode[] = "xtype: 'textfield'";
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

        return forward_static_call(['self', '_implode'], $fieldCode);
    }
}