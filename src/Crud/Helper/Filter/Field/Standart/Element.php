<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Filter\Field\Standart;

use Vein\Core\Crud\Grid\Filter\Field;

/**
 * Class grid filter field helper
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Helper
 */
class Element extends \Vein\Core\Crud\Helper
{
	/**
	 * Generates a widget to show a html grid filter
	 *
	 * @param \Vein\Core\Crud\Grid\Filter\Field $filter
	 * @return string
	 */
	static public function _(Field $field)
	{
        if ($field instanceof Field\Submit) {
            $field->getElement()->setAttribute('class', 'btn');
        }
        $code = $field->getElement()->render();

		return '<td>'.$code.'</td>';
	}
}