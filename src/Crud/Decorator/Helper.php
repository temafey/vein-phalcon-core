<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Decorator;

use	Vein\Core\Crud\Grid,
    Vein\Core\Crud\Grid\Filter,
    Vein\Core\Crud\Grid\Filter\Field as FilterField,
    Vein\Core\Crud\Form,
    Vein\Core\Crud\Form\Field as FormField;

/**
 * Class Factory for grid helpers.
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage helper
 */
class Helper 
{
    /**
     * Factory for \Vein\Core\Crud\helper classes.
     *
     * @param string|array $helper
     * @param mixed $element
     * @return \Vein\Core\Crud\Helper\AbstactHelper
     */
    public static function factory($helper, $element)
    {
        $config = [];
        if (is_array($helper)) {
            if (!isset($helper['helper'])) {
                throw new \Vein\Core\Exception('Helper not set');
            }
            if (isset($helper['config'])) {
                if (!is_array($helper['config'])) {
                    throw new \Vein\Core\Exception("In helper '{$helper['helper']}' config is not array");
                }
                $config = $helper['config'];
            }
            if (isset($helper['element'])) {
                $method = 'get'.ucfirst($helper['element']);
                $element = call_user_func([$element, $method]);
            }
            $helper = $helper['helper'];
        }

        /*
         * helper full helper class name
         */
        $helperNamespace = self::getHelperNamespace($element);
        if (isset($config['namespace'])) {
            if ($config['namespace'] != '') {
                $helperNamespace = $config['namespace'];
            }
            unset($config['namespace']);
        }

        $helperName = $helperNamespace.'\\'.ucfirst($helper);

        /*
         * Load the helper class.  This throws an exception
         * if the specified class cannot be loaded.
         */
        if (!class_exists($helperName)) {
            throw new \Vein\Core\Exception("FAILED TO FIND $helperName");
        }

        /*
         * Create an instance of the helper class.
         */
        $helper = new $helperName();

        /*
         * Verify that the object created is a descendent of the abstract helper type.
         */
        if (!$helper instanceof \Phalcon\Tag) {
            throw new \RuntimeException("helper class '$helperName' does not implements \Phalcon\Tag");
        }

        return ['helper' => $helper, 'element' => $element];
    }

    /**
     * Return helper namespace
     *
     * @param mixed $object
     * @return string
     */
    static function getHelperNamespace($object)
    {
        if ($object instanceof Grid) {
            return '\Vein\Core\Crud\Helper\Grid';
        } elseif ($object instanceof Filter) {
            return '\Vein\Core\Crud\Helper\Filter';
        } elseif ($object instanceof FilterField) {
            return '\Vein\Core\Crud\Helper\Filter\Field';
        } elseif ($object instanceof Form) {
            return '\Vein\Core\Crud\Helper\Form';
        } elseif ($object instanceof FormField) {
            return '\Vein\Core\Crud\Helper\Form\Field';
        } else {
            throw new \Vein\Core\Exception("Helper object '".get_class($object)."' not instance");
        }
    }
}