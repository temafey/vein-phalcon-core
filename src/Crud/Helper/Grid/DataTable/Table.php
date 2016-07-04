<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Grid\DataTable;

use Vein\Core\Crud\Grid\DataTable as Grid,
    Vein\Core\Crud\Grid\Column,
    Vein\Core\Crud\Form\Field,
    Vein\Core\Crud\Helper\Form\DataTable\BaseHelper as FieldHelper;

/**
 * Class grid columns helper
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Helper
 */
class Columns extends BaseHelper
{
	/**
	 * Generates grid columns object
	 *
	 * @param \Vein\Core\Crud\Grid\DataTable $grid
     *
     * @return string
	 */
	static public function _(Grid $grid)
	{
        $code = '';
        
        return $code;
	}


    /**
     * Implode column components to formated string
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