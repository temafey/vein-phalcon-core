<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Form\DataTable;

use Vein\Core\Crud\Form\DataTable as Form,
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
	 * @param \Vein\Core\Crud\Form\DataTable $form
	 * @return string
	 */
	static public function _(Form $form)
	{
        $code = '
            fields: [';

        $fields = [];
        foreach ($form->getFields() as $field) {
            if ($field instanceof Field) {
                if ($field instanceof Field\ArrayToSelect) {
                    $field->setAttrib('autoLoad', false);
                    $field->setAttrib('isLoaded', true);
                    $field->setAttrib('changeListener', true);
                }
                $fields[] = self::renderField($field);
            }
        }

        $code .= implode(',', $fields);

        $code .= '
             ]';

        return $code;
	}
}
