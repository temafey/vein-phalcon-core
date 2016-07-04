<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Filter\Standart;

use Vein\Core\Crud\Grid\Filter,
    Vein\Core\Crud\Grid\Filter\Field;

/**
 * Class grid columns helper
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Helper
 */
class FormFoot extends BaseHelper
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
        $code = '
            <div class="box-footer">';

		foreach ($filter->getFields() as $field) {
			if ($field instanceof Field\Submit) {
				$code .= self::renderField($field);
				break;
			}
		}

        return $code;
	}

    /**
     * Crud helper end tag
     *
     * @param \Vein\Core\Crud\Grid\Filter $filter
     *
     * @return string
     */
    static public function endTag(Filter $filter)
    {
        return '
            </div>';
    }
}