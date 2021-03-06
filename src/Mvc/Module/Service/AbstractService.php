<?php
/**
 * @namespace
 */
namespace Vein\Core\Mvc\Module\Service;

/**
 * Class AbstractService
 *
 * @category   Vein\Core
 * @package    Mvc
 * @subpackage Module
 */
abstract class AbstractService implements \Phalcon\DI\InjectionAwareInterface, \Phalcon\Events\EventsAwareInterface
{
    use \Vein\Core\Tools\Traits\DIaware,
        \Vein\Core\Tools\Traits\EventsAware;

    /**
     * Module
     * @var \Vein\Core\Mvc\Module\Base
     */
    protected $_module;

    /**
     * Config
     * @var \Phalcon\Config
     */
    protected $_config;

	/**
	 * Constructor
	 *
     * @param \Vein\Core\Mvc\Module\Base $module
	 * @param \Phalcon\DiInterface $dependencyInjector
	 * @param \Phalcon\Events\ManagerInterface $eventManager
     * @param \Phalcon\Config $config
	 */
	public function __construct(\Vein\Core\Mvc\Module $module, \Phalcon\DiInterface $dependencyInjector, \Phalcon\Events\ManagerInterface $eventsManager, \Phalcon\Config $config)
	{
        $this->_module = $module;
		$this->setDi($dependencyInjector);
		$this->setEventsManager($eventsManager);
        $this->_config = $config;
	}
	
	/**
	 * Service register method
	 */
	abstract public function register();
}