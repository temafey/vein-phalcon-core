<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Filter;

use Vein\Core\Crud\Grid\Filter;

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
	 * @param \Vein\Core\Crud\Grid\Filter $filter
	 * @return string
	 */
	static public function _(Filter $filter)
	{
        $filter->initForm();
        $form = $filter->getForm();
        $code = '<form method="'.$filter->getMethod().'" action="'.$filter->getAction().'" class="form-inline">';
        $code .= "
            <legend>".$filter->getTitle()."</legend>
            <table>";

		return $code;
	}

    /**
     * Crud helper end tag
     *
     * @return string
     */
    static public function endTag()
    {
        return '
        </table></form>';
    }
}