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
class Image extends BaseHelper
{
    /**
     * Render DataTable image file uplaod form field
     *
     * @param \Vein\Core\Crud\Form\Field $field
     * @return string
     */
    public static function _(Field\Image $field)
    {
        $fieldCode = [];

        if ($field->isHidden()) {
            $fieldCode[] = 'type: \'hidden\'';
        } else {
            $fieldCode[] = 'type: \'upload\'';
        }
        if ($field->isNotEdit()) {
            $fieldCode[] = 'readonly: true';
        }
        $fieldCode[] = 'name: \''.$field->getKey().'\'';

        $label = $field->getLabel();
        if ($label) {
            $fieldCode[] = 'label: \''.$label.'\'';
        }
        $desc = $field->getDesc();
        if ($desc) {
            $fieldCode[] = 'fieldInfo: \''.$desc.'\'';
        }
        $fieldCode[] = 'allowBlank: '.(($field->isRequire()) ? 'false' : 'true');

        $attribs = [];
        $fieldCode[] = 'attr:  {
                '.forward_static_call(['self', '_implode'], $attribs).'
            }
        ';
    }
}