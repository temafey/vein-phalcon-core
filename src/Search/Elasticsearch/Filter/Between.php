<?php
/**
 * @namespace
 */
namespace Vein\Core\Search\Elasticsearch\Filter;

use \Vein\Core\Search\Elasticsearch\Query\Builder;

/**
 *  Between filter
 *
 * @category   Vein\Core
 * @package    Db
 * @subpackage Filter
 */
class Between extends Standart
{
    /**
     * Filter field
     * @var string
     */
    protected $_field;

    /**
     * Max value
     * @var string|integer
     */
    protected $_min;

    /**
     * Max value
     * @var string|integer
     */
    protected $_max;

    /**
     * @var string
     */
    protected $_criteria;

    /**
     * @param string $field
     * @param string|integer $min
     * @param string|integer $max
     * @param string $criteria
     */
    public function __construct($field, $min, $max, $criteria = null)
    {
        $this->_field = $field;
        $this->_min = $min;
        $this->_max = $max;
        $this->_criteria = ($criteria !== null) ? $criteria : static::CRITERIA_EQ;
    }

    /**
     * Apply filter to query builder
     *
     * @param \Vein\Core\Search\Elasticsearch\Query\Builder $dataSource
     *
     * @return string
     */
    public function filter(Builder $dataSource)
    {
        $filter = new \Elastica\Query\Range($this->_field, ['gte' => $this->_min, 'lte' => $this->_max]);
        $boost = $this->getBoostParam();
        $filter->setParam('boost', $boost);

        return $filter;
    }

}
