<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Container;

use	Vein\Core\Crud\Grid,
    Vein\Core\Crud\Form;
/**
 * Class Factory for grid containers.
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Container
 */
class Container 
{
    /**
     * Factory for \Vein\Core\Crud\Container classes.
     *
     * @param .
     * @param mixed $config  OPTIONAL; an array or \Zend\Config\Config object with adapter parameters.
     *
     * @return \Vein\Core\Crud\Container\Grid\Adapter || \Vein\Core\Crud\Container\Form\Adapter
     */
    public static function factory($object, $config = [])
    {
        /*
         * Verify that adapter parameters are in an array.
         */
        if (!is_array($config)) {
            throw new \Vein\Core\Exception('Adapter parameters must be in an array or a Phalcon\Config object');
        }

        /*
         * Verify that an adapter name has been specified.
         */
    	if (!isset($config['adapter'])) {
            throw new \Vein\Core\Exception("Container adapter class name not set");
        }
    	if ($config['adapter'] == '') {
        	throw new \Vein\Core\Exception("Empty container adapter class name in config options array");
        }
        $containerName = $config['adapter'];
        unset($config['adapter']);
        
        if (!isset($config['model'])) {
            throw new \Vein\Core\Exception("Container model class name not set");
        }
    	if ($config['model'] == '') {
        	throw new \Vein\Core\Exception("Empty container model class name in config options array");
        }
        if (isset($config['modelAdapter'])) {
            $config['adapter'] = $config['modelAdapter'];
            unset($config['modelAdapter']);
        }
        //$containerModel = $config['model'];
        //unset($config['model']);
        
        /*
         * Container full adapter class name
         */
        $containerNamespace = self::getContainerNamespace($object);
        if (isset($config['namespace'])) {
            if ($config['namespace'] != '') {
                $containerNamespace = $config['namespace'];
            }
            unset($config['namespace']);
        }

        $containerName = $containerNamespace.'\\'.$containerName;
        
        /*
         * Load the adapter class.  This throws an exception
         * if the specified class cannot be loaded.
         */
        if (!class_exists($containerName)) {
            echo "FAILED TO FIND $containerName\n";
        }

        /*
         * Create an instance of the adapter class.
         * Pass the config to the adapter class constructor.
         */
        $containerAdapter = new $containerName($object, $config);

        /*
         * Verify that the object created is a descendent of the abstract adapter type.
         */
        if (! $containerAdapter instanceof AbstractContainer) {
            throw new \Vein\Core\Exception("Container class '$containerName' does not implements Crud\Container\AbstractContainer");
        }

        return $containerAdapter;
    }
    
    /**
     * Return conatiner namespace
     * 
     * @param mixed $object
     *
     * @return string
     */
    static function getContainerNamespace($object)
    {
    	if ($object instanceof Grid) {
    		return '\Vein\Core\Crud\Container\Grid';
    	} elseif ($object instanceof Form) {
    		return '\Vein\Core\Crud\Container\Form';
    	} else {
    		throw new \Vein\Core\Exception("Container object '".get_class($object)."' not instance");
    	}
    }
}