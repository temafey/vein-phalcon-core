<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Filter\Standart;

use Vein\Core\Crud\Form,
    Vein\Core\Crud\Form\Field;

/**
 * Class grid columns helper
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Helper
 */
class FormHead extends BaseHelper
{
	/**
	 * Generates grid table colums head
	 *
	 * @param Vein\Core\Crud\Grid\Filter  $filter
     * 
	 * @return string
	 */
	static public function _(Filter $filter)
	{
        $code = '	        <div class="box-header with-border">
			  <h3 class="box-title">'.$filter->getTitle().'</h3>
			 <!-- tools box -->
			  <div class="pull-right box-tools">
				<button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title=\'\' data-original-title="Collapse">
				  <i class="fa fa-minus"></i></button>
				<button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
				  <i class="fa fa-times"></i></button>
			  </div>			  
			</div>';

        return $code;
	}
}