<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Form\Field\DataTable;

use Vein\Core\Crud\Helper\Form\DataTable\BaseHelper as Base;

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
     * Implode field components to formated string
     *
     * @param array $components
     *
     * @return string
     */
    public static function _implode(array $components)
    {
        return "\n\t\t\t\t{\n\t\t\t\t\t".implode(",\n\t\t\t\t\t", $components)."\n\t\t\t\t}";
    }
}