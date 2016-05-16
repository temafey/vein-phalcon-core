<?php
/**
 * @namespace
 */
namespace Vein\Core\Db\Filter;

use \Vein\Core\Mvc\Model\Query\Builder;

/**
 *  Match filter
 *
 * @category   Vein\Core
 * @package    Db
 * @subpackage Filter
 */
class Match extends AbstractFilter
{
    /**
     * Match fileds
     * @var array
     */
    protected $_column = [];

    /**
     * Filter expression
     * @var string
     */
    protected $_expr;

    /**
     * @param array $columns
     * @param $expr
     */
    public function __construct(array $columns, $expr)
	{
		$this->_expr = $expr;
		$this->_columns = $columns;
	}

    /**
     * Apply filter to query builder
     *
     * @param \Vein\Core\Mvc\Model\Query\Builder $dataSource
     * @return string
     */
    public function filterWhere(Builder $dataSource)
    {
        $adapter =  $dataSource->getModel()->getReadConnection();
        $columns = [];
		foreach ($this->_columns as $column) {
			$columns[] = $adapter->escapeIdentifier($column);
		}
		$expr = implode(',', $columns);
        $this->setBoundParamKey(implode('_', $columns));

		return 'MATCH ('.$expr.') AGAINST (:'.$this->getBoundParamKey().':)';
	}

    /**
     * Return bound params array
     *
     * @param \Vein\Core\Mvc\Model\Query\Builder $dataSource
     * @return array
     */
    public function getBoundParams(Builder $dataSource)
    {
        $key = $this->getBoundParamKey();
        $adapter =  $dataSource->getModel()->getReadConnection();

        return [$key => $this->_expr];
    }

}
