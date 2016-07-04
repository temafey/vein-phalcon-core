<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Decorator;

use	Vein\Core\Crud\Grid,
    Vein\Core\Crud\Grid\Filter,
    Vein\Core\Crud\Form;

/**
 * Class Factory for grid decorators.
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Decorator
 */
class Decorator 
{
    /**
     * Factory for \Vein\Core\Crud\Decorator classes.
     *
     * @param \Vein\Core\Crud\Form\Field|\Vein\Core\Crud\Form|\Vein\Core\Crud\Grid $element
     * @param mixed $config
     *
     * @return \Vein\Core\Crud\Decorator
     */
    public static function factory($element, array $config = [])
    {
        /*
         * Verify that an decorator name has been specified.
         */
    	if (!isset($config['decorator'])) {
            throw new \RuntimeException("Decorator class name not set");
        }
    	if ($config['decorator'] == '') {
        	throw new \RuntimeException("Empty decorator decorator class name in config options array");
        }
        $decoratorName = $config['decorator'];
        unset($config['decorator']);

        //$decoratorModel = $config['template'];
        //unset($config['template']);
        
        /*
         * Decorator full decorator class name
         */
        $decoratorNamespace = self::getDecoratorNamespace($element);
        if (isset($config['namespace'])) {
            if ($config['namespace'] != '') {
                $decoratorNamespace = $config['namespace'];
            }
            unset($config['namespace']);
        }

        $decoratorName = $decoratorNamespace.'\\'.ucfirst($decoratorName);
        
        /*
         * Load the decorator class.  This throws an exception
         * if the specified class cannot be loaded.
         */
        if (!class_exists($decoratorName)) {
            throw new \Vein\Core\Exception("FAILED TO FIND $decoratorName");
        }

        /*
         * Create an instance of the decorator class.
         * Pass the config to the decorator class constructor.
         */
        $decorator = new $decoratorName($config);
        $decorator->setElement($element);

        /*
         * Verify that the object created is a descendent of the abstract decorator type.
         */
        if (!$decorator instanceof \Vein\Core\Crud\Decorator) {
            throw new \RuntimeException("Decorator class '$decoratorName' does not implements Crud\Decorator\AbstractDecorator");
        }

        return $decorator;
    }
    
    /**
     * Return decorator namespace
     * 
     * @param mixed $object
     *
     * @return string
     */
    static function getDecoratorNamespace($object)
    {
    	if ($object instanceof Grid) {
    		return '\Vein\Core\Crud\Decorator\Grid';
    	} elseif ($object instanceof Form) {
    		return '\Vein\Core\Crud\Decorator\Form';
    	} elseif ($object instanceof Filter) {
            return '\Vein\Core\Crud\Decorator\Filter';
        } else {
    		throw new \Vein\Core\Exception("Decorator object '".get_class($object)."' not instance");
    	}
    }
}