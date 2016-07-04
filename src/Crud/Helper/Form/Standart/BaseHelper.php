<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Form\Standart;

use Vein\Core\Crud\Helper\Grid\Standart\BaseHelper as Base,
    Vein\Core\Crud\Decorator\Helper,
    Vein\Core\Crud\Form\DataTable as Form;

/**
 * Class html grid helper
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Helper
 */
class BaseHelper extends Base
{

    /**
     * Render filter form field
     *
     * @param \Vein\Core\Crud\Form\Field $field
     * @return string
     */
    static public function renderField(Field $field)
    {
        $helpers = $field->getHelpers();
        foreach ($helpers as $i => $helper) {
            $helpers[$i] = Helper::factory($helper, $field);
        }

        $sections = [];
        foreach ($helpers as $helper) {
            $sections[] = call_user_func_array([$helper['helper'], '_'], [$helper['element']]);
        }

        $separator = self::getSeparator();
        $elementContent = implode($separator, $sections);

        foreach (array_reverse($helpers) as $helper) {
            $elementContent .= call_user_func_array([$helper['helper'], 'endTag'], [$helper['element']]);
        }

        return $elementContent;
    }

}