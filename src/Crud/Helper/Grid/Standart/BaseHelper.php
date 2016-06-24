<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Grid\Standart;

use Vein\Core\Crud\Grid\DataTable as Grid,
    Vein\Core\Crud\Helper\Tools\Requires;

/**
 * Class html grid helper
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Helper
 */
class BaseHelper extends \Vein\Core\Crud\Helper
{
    use Requires;

    /**
     * Is create file prototype
     * @var boolean
     */
    protected static $_createFile = false;

    /**
     * Application name
     * @var string
     */
    protected static $_module;

    /**
     * Object prefix
     * @var string
     */
    protected static $_prefix;

    /**
     * Init helper
     *
     * @param \Vein\Core\Crud\Grid\DataTable|\Vein\Core\Crud\Form\DataTable $element
     * @return string
     */
    public static function init($element)
    {
        static::$_module = \Phalcon\Text::camelize($element->getModuleName());
        static::$_prefix = \Phalcon\Text::camelize($element->getKey());
    }

    /**
     * Return object name
     *
     * @return false
     */
    public static function getName()
    {
        return false;
    }

    /**
     * Return grid object name
     *
     * @return string
     */
    public static function getGridName()
    {
        return static::$_module.'_'.static::$_prefix.'Grid';
    }

    /**
     * Return form object name
     *
     * @return string
     */
    public static function getFormName()
    {
        return static::$_module.'_'.static::$_prefix.'Form';
    }

    /**
     * Return grid filter object name
     *
     * @return string
     */
    public static function getFilterName()
    {
        return static::$_module.'_'.static::$_prefix.'Filter';
    }

    /**
     * Is create js file prototype
     *
     * @return boolean
     */
    public static function createFile()
    {
        return static::$_createFile;
    }

    /**
     * Return js file path from name
     *
     * @return string
     */
    public static function getFilePath($name)
    {
        return str_replace('.', '/', $name).'.phtml';
    }
}