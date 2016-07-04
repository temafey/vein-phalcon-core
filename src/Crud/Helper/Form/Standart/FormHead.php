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
class FormHead extends BaseHelper
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
        $code = '	        <div class="box-header with-border">
			  <h3 class="box-title">'.$crudForm->getTitle().'</h3>
			 <!-- tools box -->		  
			</div>';

        return $code;
	}
}