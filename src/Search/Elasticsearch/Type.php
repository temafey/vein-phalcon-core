<?php
/**
 * @namespace
 */
namespace Vein\Core\Search\Elasticsearch;

use Elastica\Type as ElType;

/**
 * Class Type
 *
 * @category    Vein\Core
 * @package     Search
 * @subcategory Elasticsearch
 */
class Type extends ElType implements
    \Phalcon\Events\EventsAwareInterface,
    \Phalcon\DI\InjectionAwareInterface
{
    use \Vein\Core\Tools\Traits\DIaware,
        \Vein\Core\Tools\Traits\EventsAware;

    /**
     * Model object
     * @var \Vein\Core\Search\Elasticsearch\ModelAdapter
     */
    protected $_model;

    /**
     * Dependency injection adapter name
     * @var string
     */
    protected $_adapter = 'elastic';

    /**
     * Creates a new type object inside the given model.
     *
     * @param \Vein\Core\Search\Elasticsearch\ModelAdapter $index Index Object
     */
    public function __construct(\Vein\Core\Search\Elasticsearch\ModelAdapter $model)
    {
        $this->_model = $model;
        $this->_name = $model->getSearchSourceType();
        $this->setSource();
        if ($this->_name === null) {
            throw new \Vein\Core\Exception("Elastic type source name not set!");
        }
    }

    /**
     * Returns index client
     *
     * @return \Elastica\Index Index object
     */
    public function getIndex()
    {
        if (null === $this->_index) {
            if ($this->_adapter instanceof Client) {
                $this->_index = $this->_adapter->getIndex($this->_model);
            } else {
                $this->_index = $this->getDi()->get($this->_adapter)->getIndex($this->_model);
            }
        }

        return $this->_index;
    }

    /**
     * Set elastic adapter name
     *
     * @param string $adapter
     * @return \Vein\Core\Search\Elasticsearch\Type
     */
    public function setAdapter($adapter)
    {
        $this->_adapter = $adapter;
        return $this;
    }

    /**
     * Set elastic type name
     *
     * @param string $source
     * @return \Vein\Core\Search\Elasticsearch\Type
     */
    public function setSource()
    {
    }
}