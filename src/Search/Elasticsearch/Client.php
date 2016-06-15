<?php
/**
 * @namespace
 */
namespace Vein\Core\Search\Elasticsearch;

use Elastica\Client as ElCient;

/**
 * Class Type
 *
 * @category    Vein\Core
 * @package     Search
 * @subcategory Elasticsearch
 */
class Client extends ElCient implements
    \Phalcon\Events\EventsAwareInterface,
    \Phalcon\DI\InjectionAwareInterface
{
    use \Vein\Core\Tools\Traits\DIaware,
        \Vein\Core\Tools\Traits\EventsAware;

    /**
     * Returns the index for the given connection
     *
     * @param  \Vein\Core\Search\Elasticsearch\ModelAdapter $model
     * @return \Vein\Core\Search\Elasticsearch\Index Index for the given name
     */
    public function getIndex(\Vein\Core\Search\Elasticsearch\ModelAdapter $model)
    {
        $prefix = $this->getConfig('prefix');
        $model->setSearchSourcePrefixKey($prefix);

        return new Index($model, $this);
    }
}