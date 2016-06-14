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
class Description extends \Vein\Core\Crud\Helper
{
	/**
	 * Generates a widget to show a html grid filter
	 *
	 * @param \Vein\Core\Crud\Grid\Filter\Field $filter
	 * @return string
	 */
	static public function _(Field $field)
	{
        $code = '';
        $desc = $field->getDesc();
        if (!$desc) {
            $code = 'span.help-block '.$field->getDesc();
        }
		
		return $code;
	}
}