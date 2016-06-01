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
class ManyToMany extends BaseHelper
{
    /**
     * Render DataTable combobox form field
     *
     * @param \Vein\Core\Crud\Form\Field\ManyToMany $field
     * @return string
     */
    public static function _(Field\ManyToMany $field)
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

        $attribs = [];
        $fieldCode[] = 'attr:  {
                '.forward_static_call(['self', '_implode'], $attribs).'
            }
        ';
    }

    /**
     * Return combobox datastore code
     *
     * @param Field\ArrayToSelect $field
     * @return string
     */
    protected static function _getStore(Field\ManyToMany $field)
    {
        $key = $field->getKey();
        $form = $field->getForm();
        $formKey = $form->getKey();
        $url = $form->getAction()."/".$key."/multi-options";

        $autoLoad = ($field->getAttrib('autoLoad')) ? true : false;
        $isLoaded = ($field->getAttrib('isLoaded')) ? true : false;

        $store = "new Ext.data.Store({
                        autoLoad: ".($autoLoad ? "true" : "false").",
                        pageSize: 10,"
            .($isLoaded ? "
                        isLoaded: false," : "")."
                        fields: [{name: 'id'}, {name: 'name'}],
                        proxy: {
                            type: 'ajax',
                            url: '".$url."',
                            reader: {
                                root: '".$formKey."',
                                type: 'json',
                                totalProperty: 'results'
                            }
                        }
                    })";

        return $store;
    }

    /**
     * Return combobox listeners code
     *
     * @param Field\ArrayToSelect $field
     * @return string
     */
    protected static function _getListeners(Field\ManyToMany $field)
    {
        $listeners = "{";

        $listeners .= "
                    }";

        return $listeners;
    }
}