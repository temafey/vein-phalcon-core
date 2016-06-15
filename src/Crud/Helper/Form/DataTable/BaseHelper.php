<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Form\DataTable;

use Vein\Core\Crud\Helper\Grid\DataTable\BaseHelper as Base,
    Vein\Core\Crud\Form\DataTable as Form;

/**
 * Class html form helper
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
    public static function renderField(\Vein\Core\Crud\Form\Field $field)
    {
        $helperName = self::getFieldHelper($field);
        $helper = \Vein\Core\Crud\Decorator\Helper::factory($helperName, $field);

        $elementContent = call_user_func_array([$helper['helper'], '_'], [$helper['element']]);
        $elementContent .= call_user_func([$helper['helper'], 'endTag']);

        return $elementContent;
    }

    /**
     * Return DataTable form field helper name
     *
     * @param \Vein\Core\Crud\Form\Field $field
     * @return string
     */
    public static function getFieldHelper(\Vein\Core\Crud\Form\Field $field)
    {
        $reflection = new \ReflectionClass(get_class($field));
        $name = $reflection->getShortName();

        return 'DataTable\\'.$name;
    }
}