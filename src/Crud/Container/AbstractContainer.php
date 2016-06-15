<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Container;

/**
 * Class AbstractContainer.
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Container
 */
abstract class AbstractContainer implements
    \Phalcon\Events\EventsAwareInterface,
    \Phalcon\DI\InjectionAwareInterface
{
    use \Vein\Core\Tools\Traits\DIaware,
        \Vein\Core\Tools\Traits\EventsAware;

	const MODEL          = 'model';
    const ADAPTER	     = 'adapter';
	const JOINS          = 'joins';
	const CONDITIONS	 = 'conditions';
	
	/**
	 * Database model
	 * @var \Vein\Core\Mvc\Model
	 */
	protected $_model;

    /**
     * Database model adapter
     * @var string|array
     */
    protected $_adapter;
	
	/**
	 * Joins to database
	 * @var array
	 */
	protected $_joins = [];
	
	/**
	 * Container conditions
	 * @var array
	 */
	protected $_conditions = [];
	
	/**
	 * Set container options
	 * 
	 * @param array $options
	 * @return \Vein\Core\Crud\Container\AbstractContainer
	 */
	public function setOptions(array $options)
	{
        if (isset($options[static::ADAPTER])) {
            $this->setAdapter($options[static::ADAPTER]);
        }
        if (isset($options[static::CONDITIONS])) {
            $this->setConditions($options[static::CONDITIONS]);
        }
        if (isset($options[static::MODEL])) {
            $this->setModel($options[static::MODEL]);
        }
        if (isset($options[static::JOINS])) {
            $this->setJoinModels($options[static::JOINS]);
        }
        if (isset($options[static::JOINS])) {
            $this->setJoinModels($options[static::JOINS]);
        }
        
        return $this;
	}
	
	/**
	 * Return database model
	 * 
	 * @return \Vein\Core\Mvc\Model
	 */
	public function getModel()
	{
		return $this->_model;
	}

    /**
     * Return database model adapter
     *
     * @return string\object
     */
    public function getAdapter()
    {
        return $this->_adapter;
    }
	
	/**
	 * Set container conditions
	 * 
	 * @param array|string $conditions
	 * @return \Vein\Core\Crud\Container\AbstractContainer
	 */
	public function setConditions($conditions)
	{
		if (null === $conditions || $conditions === false) {
			return false;
		}
		if (!is_array($conditions)) {
			$conditions = array($conditions);
		}
		foreach ($conditions as $cond) {
			if ($cond == "") {
				continue;
			}
			$this->_conditions[] = $cond;
		}
		
		return $this;
	}
	
	/**
	 * Set primary model
	 * 
	 * @param string|array $model
	 * @return void
	 */
	abstract public function setModel($model = null);

    /**
     * Set model adapter
     *
     * @param string|object $model
     * @return void
     */
    abstract public function setAdapter($adapder = null);
	
	/**
	 * Set join models
	 * 
	 * @param array|string $models
	 * @return void
	 */
	abstract public function setJoinModels($models);
}