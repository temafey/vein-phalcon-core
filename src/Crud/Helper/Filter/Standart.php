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
     *
     * @return string
	 */
	static public function _(Filter $filter)
	{
		$filter->initForm();
		$form = $filter->getForm();
		$code = '         <div class="box box-info">
			';

		$code .= '
		<!-- grid filter form -->
		<form method="'.$filter->getMethod().'" action="'.$filter->getAction().'" class="form-horizontal">';

		return $code;
	}

    /**
     * Crud helper end tag
     *
	 * @param \Vein\Core\Crud\Grid\Filter\Field $filter
	 *
     * @return string
     */
    static public function endTag(Filter $filter)
    {
		return '
		</form>
		<!-- /. grid filter form -->
	</div>';
    }
}