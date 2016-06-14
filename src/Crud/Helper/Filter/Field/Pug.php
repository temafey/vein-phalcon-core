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
class Pug extends \Vein\Core\Crud\Helper
{
	/**
	 * Generates a widget to show a html grid filter
	 *
	 * @param \Vein\Core\Crud\Grid\Filter\Field $filter
	 * @return string
	 */
	static public function _(Field $field)
	{
        $code = '.form-group';

		$element = $field->getElement();

		//Get any generated messages for the current element
		$messages = $element->getMessages();
		if (count($messages)) {
			$code .= '.has-error';
		}

		return $code;
	}

    /**
     * Crud helper end tag
     *
     * @return string
     */
    static public function endTag()
    {
        return '';
    }
}