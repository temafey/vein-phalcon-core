<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Grid\Extjs;

use Vein\Core\Crud\Grid\Extjs as Grid;

/**
 * Class grid filter helper
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Helper
 */
class Store extends BaseHelper
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
        $limit = $grid->getLimit();
        $title = $grid->getTitle();
        $action = $grid->getAction();
        $key = $grid->getKey();

        $code = "
        Ext.define('".static::getGridStoreName()."', {
            extend: 'Ext.ux.crud.Store',
            alias: 'widget.".static::$_module.ucfirst(static::$_prefix)."Store',
            requires: ['Ext.ux.crud.Proxy', 'Ext.ux.crud.Store'],
            model: '".static::getGridModelName()."',
            pageSize: ".$limit.",
            autoLoad: false,
            remoteSort: true,
            proxy: {
                type: 'crudproxy',
                api: {
                    read:    '".$action."/read',
                    update:  '".$action."/update',
                    create:  '".$action."/create',
                    destroy: '".$action."/delete'
                },
                reader: {
                    type: 'json',
                    root: '".$key."',
                    totalProperty: 'results'
                },
                writer: {
                    type: 'json',
                    writeAllFields: false,
                    root: '".$key."'
                }
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
        return static::getGridStoreName();
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