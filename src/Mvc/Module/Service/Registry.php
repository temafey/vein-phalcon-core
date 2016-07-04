<?php
/**
 * @namespace
 */
namespace Vein\Core\Mvc\Module\Service;

use Vein\Core\Mvc\Module\Service\AbstractService;

/**
 * Class Registry
 *
 * @category   Vein\Core
 * @package    Mvc
 * @subpackage Moduler
 */
class Registry extends AbstractService
{
    /**
     * Initializes viewer
     */
    public function register()
    {
        $dependencyInjector = $this->getDi();
        $registry = new \Phalcon\Registry();

        $dependencyInjector->set('registry', function () use ($registry) {
            return $registry;
        });
    }

    /**
     * Registry hash-table
     *
     * @var array
     */
    protected static $_registry = array();

    /**
     * Put item into the registry
     *
     * @param string $key
     * @param mixed $item
     *
     * @return void
     */
    public function __set($key, $item)
    {
        if (!array_key_exists($key, self::$_registry)) {
            self::$_registry[$key] = $item;
        }
    }

    /**
     * Get item by key
     *
     * @param string $key
     *
     * @return false|mixed
     */
    public function __get($key)
    {
        if (array_key_exists($key, self::$_registry)) {
            return self::$_registry[$key];
        }

        return false;
    }

    /**
     * Remove item from the regisry
     *
     * @param string $key
     *
     * @return void
     */
    public function __unset($key)
    {
        if (array_key_exists($key, self::$_registry)) {
            unset(self::$_registry[$key]);
        }
    }

    /**
     * Remove item from the regisry
     *
     * @param string $key
     *
     * @return void
     */
    public function __isset($key)
    {
        return (array_key_exists($key, self::$_registry)) ? true: false;
    }

} 