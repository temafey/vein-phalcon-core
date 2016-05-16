<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Grid;

use Vein\Core\Crud\Helper\Grid\Extjs\BaseHelper,
    Vein\Core\Crud\Grid\Extjs as Grid;

/**
 * Class html grid helper
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Helper
 */
class Extjs extends BaseHelper
{
    /**
     * Is create js file prototype
     * @var boolean
     */
    protected static $_createJs = true;

	/**
	 * Generates a widget to show a html grid
	 *
	 * @param \Vein\Core\Crud\Grid\Extjs $grid
	 * @return string
	 */
	static public function _(Grid $grid)
	{
        $title = $grid->getTitle();

        $code = "
        Ext.define('".static::getGridName()."', {
            extend: 'Ext.ux.crud.Grid',
            store: '".static::getGridStoreName()."',
            alias: 'widget.".static::$_module.ucfirst(static::$_prefix)."Grid',
            ";

        $width = $grid->getWidth();
        if ($width) {
            $code .= "width: ".$width.",
            ";
        }
        $height = $grid->getHeight();
        if ($width) {
            $code .= "height: ".$height.",
            ";
        }
        $editType = $grid->getEditingType();
        if ($editType) {
            static::addRequires("Ext.grid.plugin.".ucfirst($editType)."Editing");
        }
        static::addRequires("Ext.form.field.*");
        static::addRequires("Ext.ux.crud.Grid");

        $code .= "itemId: '".static::$_module.ucfirst(static::$_prefix)."Grid',";

		return $code;
	}

    /**
     * Return object name
     *
     * @return string
     */
    public static function getName()
    {
        return static::getGridName();
    }

    /**
     * Crud helper end tag
     *
     * @return string
     */
    static public function endTag()
    {
        $code = "

            requires: [";
        $code .= static::getRequires(true);
        $code .= "]";

        return $code."
        });";
    }
}