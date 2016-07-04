<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Filter\Extjs;

use Vein\Core\Crud\Helper\Grid\Extjs\BaseHelper as Base,
    Vein\Core\Crud\Grid\Filter;

/**
 * Class grid filter base helper
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
     * @param \Vein\Core\Crud\Grid\Filter\Field $field
     *
     * @return string
     */
    public static function renderField(\Vein\Core\Crud\Grid\Filter\Field $field)
    {
        $helperName = self::getFieldHelper($field);
        $helper = \Vein\Core\Crud\Decorator\Helper::factory($helperName, $field);

        $elementContent = call_user_func_array([$helper['helper'], '_'], [$helper['element']]);
        $elementContent .= call_user_func([$helper['helper'], 'endTag'], [$helper['element']]);

        return $elementContent;
    }

    /**
     * Return form field helper name
     *
     * @param \Vein\Core\Crud\Grid\Filter\Field $field
     *
     * @return string
     */
    public static function getFieldHelper(\Vein\Core\Crud\Grid\Filter\Field $field)
    {
        $reflection = new \ReflectionClass(get_class($field));
        $name = $reflection->getShortName();

        return 'extjs\\'.$name;
    }
}