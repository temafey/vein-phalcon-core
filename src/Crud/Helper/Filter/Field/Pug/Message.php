<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Filter\Field\Standart;

use Vein\Core\Crud\Grid\Filter\Field;

/**
 * Class grid filter field message helper
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Helper
 */
class Message extends \Vein\Core\Crud\Helper
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
        $element = $field->getElement();

        //Get any generated messages for the current element
        $messages = $element->getMessages();
        if (count($messages)) {
            //Print each element
            $code .= 'span.help-block';
            foreach ($messages as $message) {
                $code .= ' '.$message;
            }
        }

		return $code;
	}
}