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
class Combobox extends BaseHelper
{
    /**
     * Render DataTable combobox form field
     *
     * @param \Vein\Core\Crud\Form\Field\ArrayToSelect $field
     * @return string
     */
    public static function _(Field\ArrayToSelect $field)
    {
        $fieldCode = [];

        if ($field->isHidden()) {
            $fieldCode[] = 'type: \'hidden\'';
        } else {
            $fieldCode[] = 'type: \'select\'';
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
        $fieldCode[] = 'options: ['.forward_static_call(['self', '_getOptions'], $field).']';

        /*$attribs = [];
        $minValue = $field->getMinValue();
        if ($minValue !== null && $minValue !== false) {
            $attribs[] = ' minlength: '.$minValue;
        }
        $maxValue = $field->getMaxValue();
        if ($maxValue !== null && $maxValue !== false) {
            $attribs[] = ' maxlength: '.$maxValue;
        }
        $fieldCode[] = 'attr:  {
                '.forward_static_call(['self', '_implode'], $attribs).'
            }
        ';*/

        return forward_static_call(['self', '_implode'], $fieldCode);
    }

    /**
     * Return combobox datastore code
     *
     * @param Field\ArrayToSelect $field
     * @return string
     */
    protected static function _getOptions(Field\ArrayToSelect $field)
    {
        $options = [];
        $values = $field->getOptions();
        $values = \Engine\Tools\Arrays::assocToArray($values, 'id', 'name');

        foreach ($values as $value => $name) {
            $option = '{ label: \'' . $name . '\', value: \'' . $value . '\' }';
            $options[] = $option;
        }

        return implode(', ', $options);
    }
}