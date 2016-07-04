<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Form\Extjs;

use Vein\Core\Crud\Form\Extjs as Form;

/**
 * Class form functions helper
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Helper
 */
class Buttons extends BaseHelper
{
	/**
	 * Generates form buttons objects
	 *
	 * @param \Vein\Core\Crud\Form\Extjs $form
     *
     * @return string
	 */
	static public function _(Form $form)
	{
        $primary = $form->getPrimaryField();
        $key = ($primary) ? $primary->getKey() : false;

        $code = "

            buttonsGet: function() {
                var me = this;

                return [
                    {
                        text: 'Save',
                        itemId: 'btnSave',
                        scope: me,
                        formBind: true, //only enabled once the form is valid
                        disabled: true,
                        handler: me.onSubmit
                    },
                    {
                        text: 'Reset',
                        itemId: 'btnReset',
                        scope: me,
                        handler: me.onReset
                    }
                ]
            },
            ";

        return $code;
	}
}