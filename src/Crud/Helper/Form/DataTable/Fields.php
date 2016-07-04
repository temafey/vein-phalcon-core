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
     *
     * @return string
	 */
	static public function _(Form $form)
	{
        $code = '
            fields: [';

        $fields = [];
        
        $create = false;
        if ($form->getId() === null) {
            $create = true;
        }
        foreach ($form->getFields() as $field) {
            if ($create && $field instanceof Field\Primary) {
                continue;
            }
            if ($field instanceof Field) {
                $fields[] = self::renderField($field);
            }
        }

        $code .= implode(',', $fields);

        $code .= '
             ]';

        return $code;
	}
}
