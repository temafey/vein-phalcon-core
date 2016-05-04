<?php
/**
 * @namespace
 */
namespace Vein\Core\Tools\Traits;

/**
 * Trait dipendency injection aware.
 *
 * @category   Engine
 * @package    Tools
 */
trait DIaware
{
	/**
	 * Dependency Injection
	 * @var \Phalcon\DiInterface
	 */
	protected $_di;

	/**
	 * Sets the dependency injector
	 *
	 * @param \Phalcon\DiInterface $dependencyInjector
	 *
	 * @return void
	 */
	public function setDi(\Phalcon\DiInterface $dependencyInjector = null)
	{
		$this->_di = $dependencyInjector;
	}

	/**
	 * Returns the internal dependency injector
	 *
	 * @return \Phalcon\DiInterface
	 */
	public function getDi()
	{
		return $this->_di;
	}
	
}