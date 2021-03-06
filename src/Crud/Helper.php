<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud;

/**
 * Class Helper
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Helper
 */
abstract class Helper extends \Phalcon\Tag
{
    /**
     * Helper initialize method
     *
     * @param mixed rendered object
     * 
     * @return void
     */
    static public function init($element)
    {

    }

    /**
     * Crud helper end tag
     *
     * @param mixed rendered object
     *
     * @return string
     */
    static public function endTag($element)
    {
        return '';
    }

    /**
     * Return
     * @return string
     */
    static public function getSeparator()
    {
        return PHP_EOL;
    }
} 