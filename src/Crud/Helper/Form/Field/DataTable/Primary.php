<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Form\Field\DataTable;

use Vein\Core\Crud\Form\DataTable as Form,
    Vein\Core\Crud\Form\Field as Field;

/**
 * Class form fields helper
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Helper
 */
class Primary extends BaseHelper
{
    /**
     * Render DataTable primary form field
     *
     * @param \Vein\Core\Crud\Form\Field $field
     * @return string
     */
    public static function _(Field $field)
    {
        $fieldCode = [];

        if ($field->isHidden()) {
            $fieldCode[] = "type: 'hidden'";
        } else {
            $fieldCode[] = "type: 'text'";
        }
        $fieldCode[] = "readonly: true";

        $fieldCode[] = "name: '".$field->getKey()."'";

        $label = $field->getLabel();
        if ($label) {
            $fieldCode[] = "label: '".$label."'";
        }
        $desc = $field->getDesc();
        if ($desc) {
            $fieldCode[] = "fieldInfo: '".$desc."'";
        }

        return forward_static_call(['self', '_implode'], $fieldCode);
    }
}