<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Form;

use Vein\Core\Crud\Helper\Form\DataTable\BaseHelper,
    Vein\Core\Crud\Form\DataTable as Form;

/**
 * Class html form helper
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Helper
 */
class DataTable extends BaseHelper
{
    /**
     * Is create js file prototype
     * @var boolean
     */
    protected static $_createJs = true;

	/**
	 * Generates a widget to show a html form
	 *
	 * @param \Vein\Core\Crud\Form\DataTable $form
	 * @return string
	 */
	static public function _(Form $form)
	{
        $primary = $form->getPrimaryField()->getKey();
        $code = '
        '.static::getName().' = new $.fn.dataTable.Editor( {
            dom: \'Bfrtip\',
            display: \'bootstrap\',
            table: \'#'.static::getGridName().'\',
            ajax: \''.$form->getAction().'\',
            idSrc:  \''.$primary.'\',';

        return $code;
	}

    /**
     * Return object name
     *
     * @return string
     */
    public static function getName()
    {
        return static::getFormName();
    }

    /**
     * Crud helper end tag
     *
     * @return string
     */
    static public function endTag()
    {
        $code = '
        });';

        return $code;
    }
}