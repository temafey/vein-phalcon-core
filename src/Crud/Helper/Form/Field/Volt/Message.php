<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Form\Field\Volt;

use Vein\Core\Crud\Form\Field;

/**
 * Class grid form field message helper
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Helper
 */
class Message extends \Vein\Core\Crud\Helper
{
	/**
	 * Generates a widget to show a html grid form
	 *
	 * @param \Vein\Core\Crud\Form\Field $form
     *
     * @return string
	 */
	static public function _(Field $field)
	{
        $code = '';
        if ($field instanceof Field\Submit) {
            return $code;
        }

        $code = '
						{% for message in form.getFieldByKey(\''.$field->getKey().'\').getElement().getMessages() %}
						<span class="help-block">{{ message }}</span>
						{% endfor %}';

		return $code;
	}
}