<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Form\Extjs;

use Vein\Core\Crud\Form\Extjs as Form,
    Vein\Core\Crud\Form\Field as Field;

/**
 * Class form fields helper
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Helper
 */
class Fields extends BaseHelper
{
	/**
	 * Generates form fields object
	 *
	 * @param \Vein\Core\Crud\Form\Extjs $form
	 * @return string
	 */
	static public function _(Form $form)
	{
        $code = "

            fieldsGet: function() {
                return [";

        $fields = [];
        foreach ($form->getFields() as $field) {
            if ($field instanceof Field) {
                if ($field instanceof Field\ArrayToSelect) {
                    $field->setAttrib("autoLoad", false);
                    $field->setAttrib("isLoaded", true);
                    $field->setAttrib("changeListener", true);
                }
                $fields[] = self::renderField($field);
            }
        }

        $code .= implode(",", $fields);

        $code .= "
                ]
            },";

        return $code;
	}
}
