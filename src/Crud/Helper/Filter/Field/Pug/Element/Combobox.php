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
class Combobox extends BaseHelper
{
    /**
     * Render combobox filter field
     *
     * @param \Vein\Core\Crud\Grid\Filter\Field $field
     *
     * @return string
     */
    public static function _(Field\ArrayToSelect $field)
    {
        $fieldCode = [];

        $fieldCode[] = "xtype: 'combobox'";
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

        $fieldCode[] = "typeAhead: true";
        $fieldCode[] = "triggerAction: 'all'";
        $fieldCode[] = "selectOnTab: true";
        $fieldCode[] = "lazyRender: true";
        $fieldCode[] = "listClass: 'x-combo-list-small'";
        $fieldCode[] = "queryMode: 'local'";
        $fieldCode[] = "displayField: 'name'";
        $fieldCode[] = "valueField: 'id'";
        $fieldCode[] = "valueNotFoundText: 'Nothing found'";

        $store = forward_static_call(['static', '_getStore'], $field);
        $fieldCode[] = "store: ".$store;

        return forward_static_call(['static', '_implode'], $fieldCode);
    }
}