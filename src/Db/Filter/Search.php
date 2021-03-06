<?php
/**
 * @namespace
 */
namespace Vein\Core\Db\Filter;

use \Vein\Core\Mvc\Model\Query\Builder;

/**
 * Search filter
 *
 * @category   Vein\Core
 * @package    Db
 * @subpackage Filter
 */ 
class Search extends AbstractFilter 
{
	/**
	 * Filter columns
	 * @var array
	 */
	protected $_columns;
	
	/**
	 * Filter value
	 * @var string|integer
	 */
	protected $_value;

	/**
	 * Constructor
	 * 
	 * @param string|array $columns
	 * @param string|integer $value
	 */
	public function __construct($columns, $value) 
	{
		$this->_columns = is_array($columns) ? $columns : [$columns => self::CRITERIA_EQ];
		$this->_value = $value;
	}

    /**
     * Apply filter to query builder
     *
     * @param \Vein\Core\Mvc\Model\Query\Builder $dataSource
     *
     * @return string
     */
	public function filterWhere(Builder $dataSource)
	{
		$where = [];
		$model = $dataSource->getModel();
		foreach ($this->_columns as $column => $criteria) {		    
			if ($column === self::COLUMN_ID) {
                $alias = $dataSource->getAlias();
				$column = $model->getPrimary();
			} elseif ($column === self::COLUMN_NAME) {
			    $alias = $dataSource->getAlias();
				$column = $model->getNameExpr();
			} else {
			    $alias = $dataSource->getCorrelationName($column);
			}
            $field = $alias.'.'.$column;
            if (null == $this->_value) {
                $compare = $this->getCompareCriteria($criteria, $this->_value);
                $where[] = $field.' '.$compare.' NULL';
            } else {
                $key = $alias . '_' . $column;
                $compare = $this->getCompareCriteria($criteria, $this->_value);
                $where[] = $field.' '.$compare.' :'.$key.':';
            }
		}
		if (count($where) > 0) {
			$where = implode(' OR ', $where);
			return '('.$where.')';
		}
		
		return false;
	}

    /**
     * Return bound params array
     *
     * @param \Vein\Core\Mvc\Model\Query\Builder $dataSource
     *
     * @return array
     */
    public function getBoundParams(Builder $dataSource)
    {
        if (null == $this->_value) {
            return null;
        }
        $params = [];
        $adapter =  $dataSource->getModel()->getReadConnection();
        $exprEq = $this->_value;
        $exprLike = '%'.$exprEq.'%';
        $exprBegins = $exprEq.'%';

        $model = $dataSource->getModel();
        foreach ($this->_columns as $column => $criteria) {
            if ($column === self::COLUMN_ID) {
                $alias = $dataSource->getAlias();
                $column = $model->getPrimary();
            } elseif ($column === self::COLUMN_NAME) {
                $alias = $dataSource->getAlias();
                $column = $model->getNameExpr();
            } else {
                $alias = $dataSource->getCorrelationName($column);
            }
            $key = $alias.'_'.$column;
            if ($criteria === self::CRITERIA_EQ) {
                $params[$key] = $exprEq;
            } elseif ($criteria === self::CRITERIA_LIKE) {
                $params[$key] = $exprLike;
            } elseif ($criteria === self::CRITERIA_BEGINS) {
                $params[$key] = $exprBegins;
            } elseif ($criteria === self::CRITERIA_MORE) {
                $params[$key] = $exprEq;
            } elseif ($criteria === self::CRITERIA_LESS) {
                $params[$key] = $exprEq;
            }
        }

        if (count($params) > 0) {
            return $params;
        }

        return false;
    }
}