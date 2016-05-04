<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Grid\Filter\Field;

use Engine\Filter\SearchFilterInterface as Criteria,
    Engine\Crud\Container\AbstractContainer as Container;

/**
 * Grid filter field
 *
 * @category   Engine
 * @package    Crud
 * @subpackage Grid
 */
class Match extends Standart
{
    /**
     * Match feilds
     * @var array
     */
    protected $_fields;

    /**
     * @param string $name
     * @param string $label
     * @param string|array $fields
     */
    public function __construct($label = null, $name = false, $fields)
	{
		parent::__construct($label, $name);
		$this->_fields = is_array($fields) ? $fields : [$fields];
	}

    /**
     * Return datasource filters
     *
     * @param \Engine\Crud\Container\AbstractContainer $container
     * @return \Engine\Filter\SearchFilterInterface
     */
	public function getFilter(Container $container)
	{
        $values = $this->getValue();
		if (!$values) {
            return false;
        }

        if (!$this->checkHashValue($values)) {
            return false;
        }

        $container = $this->_gridFilter->getContainer();

        if (!is_array($values)) {
            $values = $this->_parseValue($values);
        }

        $filters = [];
        foreach ($values as $sub_values) {
            $sub_filters = [];
            foreach ($sub_values as $value) {
                if (empty($value)) {
                    continue;
                }
                $value = trim($value);
                $filter = $container->getFilter('match',  $this->_fields,  $value);
                $filter->setFilterField($this);
                $sub_filters[] = $filter;
            }
            if (!is_array($sub_filters)) {
                continue;
            }
            $filter = $container->getFilter('compound', 'OR', $sub_filters);
            $filter->setFilterField($this);
            $filters[] = $filter;
        }

        if (!is_array($filters)) {
            return false;
        }

        return $container->getFilter('compound', 'OR', $filters)->setFilterField($this);

	}

    /**
     * Parse filter value
     *
     * @param string $value
     * @return array
     */
    protected function _parseValue($value)
	{
		if (strpos($value,';') !== false) {
			$values = [];
			$tmp_values = explode(';', $value);
			foreach ($tmp_values as $value) {
				$values[] = $this->_normalizeValue($value);
			}
			return $values;			
		} else {
			return [$this->_normalizeValue($value)];
		}
	}

    /**
     * Normalize filter value
     *
     * @param $value
     * @return mixed
     */
    protected function _normalizeValue($value)
    {
		return str_replace(","," ",$value);
	}
	
}
