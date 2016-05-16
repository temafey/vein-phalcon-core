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
class Password extends BaseHelper
{
    /**
     * Render extjs password form field
     *
     * @param \Vein\Core\Crud\Form\Field $field
     * @return string
     */
    public static function _(Field\Password $field)
    {
        $fieldCode = [];

        if ($field->isHidden()) {
            $fieldCode[] = "xtype: 'hiddenfield'";
        } else {
            $fieldCode[] = "xtype: 'textfield'";
        }
        $fieldCode[] = "name: '".$field->getKey()."'";
        $fieldCode[] = "inputType: 'password'";
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
        $minLength = $field->getMinLength();
        $fieldCode[] = "minLength: ".$minLength;

        return forward_static_call(['self', '_implode'], $fieldCode);
    }
}