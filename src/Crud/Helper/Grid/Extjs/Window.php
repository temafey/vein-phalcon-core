<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Grid\Extjs;

use Vein\Core\Crud\Grid\Extjs as Grid;

/**
 * Class grid window helper
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Helper
 */
class Window extends BaseHelper
{
    /**
     * Is create js file prototype
     * @var boolean
     */
    protected static $_createJs = true;

	/**
	 * Generates grid functions object
	 *
	 * @param \Vein\Core\Crud\Grid\Extjs $grid
	 * @return string
	 */
	static public function _(Grid $grid)
	{
        $title = $grid->getTitle();
        $code = "
        Ext.define('".static::getWinName()."', {
            extend: 'Ext.Window',
            itemId: '".static::$_module.ucfirst(static::$_prefix)."Window',
            layout: 'fit',
            items: [
                { xtype: '".static::$_module.ucfirst(static::$_prefix)."Grid', itemId: '".static::$_module.ucfirst(static::$_prefix)."Grid' }
            ]
        });";

        return $code;
	}

    /**
     * Return object name
     *
     * @return string
     */
    public static function getName()
    {
        return static::getWinName();
    }

    /**
     * Crud helper end tag
     *
     * @return string
     */
    static public function endTag()
    {
        return false;
    }
}