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
class Pug extends \Vein\Core\Crud\Helper
{
	/**
	 * Generates a widget to show a html grid filter
	 *
	 * @param \Vein\Core\Crud\Grid\Filter $filter
     *
     * @return string
	 */
	static public function _(Filter $filter)
	{
        $filter->initForm();
        $form = $filter->getForm();

		$code = '	.box.box-default
		.box-header
			h3.box-title '.$form->getTitle().'
		.box-tools.pull-right
			button.btn.btn-box-tool(type=\'button\', data-widget=\'collapse\')
      			i.fa.fa-minus      		
        form.form-horizontal(method="'.$filter->getMethod().'", action="'.$filter->getAction().'")
			.box-body
				table#'.static::getGridName().'.table.table-bordered.table-striped';

        $code .= "
        	.box-footer
      			button.btn.btn-default(type='submit') Cancel
      			button.btn.btn-info.pull-right(type='submit') Sign in";

		return $code;
	}

    /**
     * Crud helper end tag
     *
     * @return string
     */
    static public function endTag()
    {
        return '</form>';
    }
}