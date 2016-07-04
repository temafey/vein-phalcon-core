<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Form\Standart;

use Vein\Core\Crud\Form,
    Vein\Core\Crud\Form\Field;

/**
 * Class grid columns helper
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Helper
 */
class FormFoot extends BaseHelper
{
	/**
	 * Generates grid table colums head
	 *
	 * @param Vein\Core\Crud\Form $crudForm
     * 
	 * @return string
	 */
	static public function _(Form $crudForm)
	{
        $code = '
            <div class="box-footer">';

		foreach ($crudForm->getFields() as $field) {
			if ($field instanceof Field\Submit) {
				$code .= self::renderField($field);
				break;
			}
		}

        return $code;
	}

    /**
     * Crud helper end tag
     *
     * @param \Vein\Core\Crud\Form $crudForm
     *
     * @return string
     */
    static public function endTag(Form $crudForm)
    {
        return '
            </div>';
    }
}