<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Filter\Field;

use Vein\Core\Crud\Grid\Filter\Field;

/**
 * Class grid filter field helper
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
	 * @param \Vein\Core\Crud\Grid\Filter\Field $filter
	 *
	 * @return string
	 */
	static public function _(Field $field)
	{
		$code = '';
		if ($field instanceof Field\Submit) {
			return $code;
		}

        $code .= '				<div class="col-md-4">
					<div class="form-group">';

		return $code;
	}

    /**
     * Crud helper end tag
     *
	 * @param \Vein\Core\Crud\Grid\Filter\Field $filter
	 *
     * @return string
     */
    static public function endTag(Field $field)
    {
		if ($field instanceof Field\Submit) {
			return '';
		}

        return '					</div>
			</div>';
    }
}