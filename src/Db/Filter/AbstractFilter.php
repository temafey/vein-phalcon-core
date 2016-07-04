<?php
/**
 * @namespace
 */
namespace Vein\Core\Db\Filter;

use \Vein\Core\Mvc\Model\Query\Builder,
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

    /**
     * Key for bound param
     * @var string
     */
    protected $_boundParamKey;

    /**
     * Crud grid filter field object
     * @var \Vein\Core\Crud\Grid\Filter\Field
     */
    protected $_filterField;

    /**
     * Apply filter to query builder
     *
     * @param \Vein\Core\Mvc\Model\Query\Builder $dataSource
     *
     * @return string
     */
	abstract public function filterWhere(Builder $dataSource);

    /**
     * Apply filter to query builder
     *
     * @param \Vein\Core\Mvc\Model\Query\Builder $dataSource
     *
     * @return string
     */
    abstract public function getBoundParams(Builder $dataSource);

	/**
	 * Apply filter to table select object
	 * 
	 * @param \Vein\Core\Mvc\Model\Query\Builder $dataSource
	 * @param mixed $value
	 */
	public function applyFilter($dataSource)
	{
        $where = $this->filterWhere($dataSource);
        if (!$where) {
            return false;
        }
        $params = $this->getBoundParams($dataSource);
        if ($params === false) {
            return false;
        }
        $dataSource->andWhere($where, $params);
	}

    /**
     * Set key for bound param value
     *
     * @param string $key
     *
     * @return \Vein\Core\Db\Filter\AbstractFilter
     */
    public function setBoundParamKey($key)
    {
        $this->_boundParamKey = $key;
        return $this;
    }

    /**
     * Return key for bound param value
     *
     * @return string
     */
    public function getBoundParamKey()
    {
        return $this->_boundParamKey;
    }

    /**
     * Return compare criteria
     *
     * @param string $criteria
     * @param mixed $value
     *
     * @return string
     */
    public function getCompareCriteria($criteria, $value)
    {
        if (null === $value) {
            if ($criteria == static::CRITERIA_NOTEQ || $criteria == static::CRITERIA_NOTIN) {
                $compare = 'IS NOT';
            } else {
                $compare = 'IS';
            }
        } else {
            switch ($criteria) {
                case static::CRITERIA_EQ:
                    $compare = '=';
                    break;
                case static::CRITERIA_NOTEQ:
                    $compare = '!=';
                    break;
                case static::CRITERIA_MORE:
                    $compare = '>=';
                    break;
                case  static::CRITERIA_LESS:
                    $compare = '<=';
                    break;
                case static::CRITERIA_MORER:
                    $compare = '>';
                    break;
                case static::CRITERIA_LESSER:
                    $compare = '<';
                    break;
                case  static::CRITERIA_LIKE:
                    $compare = 'LIKE';
                    break;
                case static::CRITERIA_BEGINS:
                    $compare = 'LIKE';
                    break;
                case static::CRITERIA_IN;
                    $compare = 'IN';
                    break;
                case static::CRITERIA_NOTIN:
                    $compare = '<';
                    break;
                default:
                    $compare = 'NOT IN';
                    break;
            }
        }

        return $compare;
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

}
