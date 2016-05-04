<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Form;

use Engine\Crud\Form;

/**
 * Class grid filter helper
 *
 * @category   Engine
 * @package    Crud
 * @subpackage Helper
 */
class Standart extends \Engine\Crud\Helper
{
	/**
	 * Generates a widget to show a html grid filter
	 *
	 * @param \Engine\Crud\Form $form
	 * @return string
	 */
	static public function _(Form $crudForm)
	{
        $crudForm->initForm();
        $form = $crudForm->getForm();
        $code = '<form method="'.$form->getMethod().'" action="'.$form->getAction().'" class="form-horizontal">';
        $code .= "
            <fieldset>
            <legend>".$crudForm->getTitle()."</legend>";

		return $code;
	}

    /**
     * Crud helper end tag
     *
     * @return string
     */
    static public function endTag()
    {
        return '</fieldset></form>';
    }
}