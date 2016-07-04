<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Form;

use Vein\Core\Crud\Form;

/**
 * Class grid filter helper
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Helper
 */
class Standart extends \Vein\Core\Crud\Helper
{
	/**
	 * Generates a widget to show a html grid filter
	 *
	 * @param \Vein\Core\Crud\Form $crudForm
     *
     * @return string
	 */
	static public function _(Form $crudForm)
	{
        $crudForm->initForm();
        $form = $crudForm->getForm();

		$code = '         <div class="box box-info">
			';

		$code .= '
		<!-- form -->
		<form method="'.$crudForm->getMethod().'" action="'.$crudForm->getAction().'" class="form-horizontal">';

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
		</form>
		<!-- /. grid filter form -->
	</div>';
    }
}