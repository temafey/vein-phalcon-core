<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Grid\Extjs\Store;

use Vein\Core\Crud\Grid\Extjs as Grid,
    Vein\Core\Crud\Helper\Grid\Extjs\BaseHelper;

/**
 * Class grid filter helper
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Helper
 */
class Local extends BaseHelper
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
     *
     * @return string
     */
    static public function _(Grid $grid)
    {
        $code = "
        Ext.define('".static::getStoreLocalName()."', {
            extend: 'Ext.data.Store',
            requires: ['Ext.data.proxy.LocalStorage'],
            model: '".static::getGridModelName()."',

            proxy: {
                type: 'localstorage',
                id  : '".static::$_prefix."'
            }
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
        return static::getStoreLocalName();
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