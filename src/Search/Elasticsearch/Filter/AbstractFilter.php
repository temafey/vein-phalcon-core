<?php
/**
 * @namespace
 */
namespace Vein\Core\Search\Elasticsearch\Filter;

use \Vein\Core\Search\Elasticsearch\Query\Builder,
    \Vein\Core\Filter\SearchFilterInterface,
    \Vein\Core\Crud\Grid\Filter\Field as FilterField,
    \Phalcon\Events\EventsAwareInterface,
    \Phalcon\DI\InjectionAwareInterface;

/**
 * Class database filters
 *
 * @category   Vein\Core
 * @package    Db
 * @subpackage Filter
 */ 
abstract class AbstractFilter implements SearchFilterInterface, EventsAwareInterface, InjectionAwareInterface
{
    use \Vein\Core\Tools\Traits\DIaware,
        \Vein\Core\Tools\Traits\EventsAware;

    CONST VALUE_TYPE_INT    = 'integer';
    CONST VALUE_TYPE_DOUBLE = 'double';
    CONST VALUE_TYPE_STRING = 'string';
    CONST VALUE_TYPE_ARRAY  = 'array';
    CONST VALUE_TYPE_DATE   = 'date';
    CONST VALUE_TYPE_GEO    = 'geo';

    /**
     * Crud grid filter field object
     * @var \Vein\Core\Crud\Grid\Filter\Field
     */
    protected $_filterField;

    /**
     * Apply filter to query builder
     *
     * @param \Vein\Core\Search\Elasticsearch\Query\Builder $dataSource
     *
     * @return string
     */
	abstract public function filter(Builder $dataSource);

	/**
	 * Apply filter to table select object
	 * 
	 * @param \Vein\Core\Search\Elasticsearch\Query\Builder $dataSource
	 * @param mixed $value
	 */
	public function applyFilter($dataSource)
	{
		$condition = $this->filter($dataSource);
		if ($condition) {
			$dataSource->apply($condition);
		}
	}

    /**
     * Normalize value for filtering
     *
     * @param mixed $value
     */
    protected function _normalizeValue(&$value)
    {
        $value = str_replace('/', '\\/', $value);
    }

    /**
     * Set crud grid filter field
     *
     * @param \Vein\Core\Crud\Grid\Filter\Field $field
     *
     * @return \Vein\Core\Search\Elasticsearch\Filter\AbstractFilter
     */
    public function setFilterField(FilterField $field)
    {
        $this->_filterField = $field;
        return $this;
    }

    /**
     * Return crud grid filter field
     *
     * @return \Vein\Core\Crud\Grid\Filter\Field
     */
    public function getFilterField()
    {
        return $this->_filterField;
    }

    /**
     * Return filter boost
     *
     * @return string
     */
    public function getBoostParam()
    {
        $boost = '1.0';
        if (!$this->_filterField) {
            return $boost;
        }
        $boostParam = $this->_filterField->getAttrib('boost');
        if ($boostParam) {
            $boost = $boostParam;
        }

        return $boost;
    }



    /**
     * Return filter slop
     *
     * @return integer
     */
    public function getSlopParam()
    {
        $slop = 1;
        if (!$this->_filterField) {
            return $slop;
        }
        $slopParam = $this->_filterField->getAttrib('slop');
        if ($slopParam) {
            $slop = $slopParam;
        }

        return $slop;
    }
}
