<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Form\Standart;

use Vein\Core\Crud\Form,
	Vein\Core\Crud\Form\Field;

/**
 * Class grid datastore helper
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Helper
 */
class Body extends BaseHelper
{
	/**
	 * Generates grid table rows
	 *
	 * @param Vein\Core\Crud\Form $crudForm
     *
     * @return string
	 */
	static public function _(Form $crudForm)
	{
		$code = '		
				<div class="box-body">';

		$fields = [];
		foreach ($crudForm->getFields() as $field) {
			if ($field instanceof Field\Submit) {
				continue;
			}

			if ($field instanceof Field) {
				$fields[] = self::renderField($field);
			}
		}
		$code .= implode("\n", $fields);

		$code .= '
            </div>';

        return $code;
	}
}