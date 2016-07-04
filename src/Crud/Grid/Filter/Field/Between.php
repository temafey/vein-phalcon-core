<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Grid\Filter\Field;

use Vein\Core\Filter\SearchFilterInterface as Criteria,
    Vein\Core\Crud\Container\AbstractContainer as Container;

/**
 * Grid filter field
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Grid
 */
class Between extends Standart
{
    /**
     * Field value data type
     * @var string
     */
    protected $_valueType = self::VALUE_TYPE_FLOAT;

    /**
     * Return datasource filters
     *
     * @param \Vein\Core\Crud\Container\AbstractContainer $container
     *
     * @return \Vein\Core\Filter\SearchFilterInterface
     */
    public function getFilter(Container $container)
    {
		$values = $this->getValue();
		if ($values) {
			$values = $this->_parseValue($values);
            return $container->getFilter('between', $values['min'], $values['max'], $this->_criteria)->setFilterField($this);
		}
		
		return false;
	}

    /**
     * Parse value string
     *
     * @param $values
     *
     * @return array|bool
     */
    protected function _parseValue($values)
	{
		if (is_string($values) && strpos($values, ';') !== false) {
			$values = explode(';', $values);		
		} 
		if (is_array($values)) {
			$min = (isset($values['min'])) ? $values['min'] : $values[0];
			$max = (isset($values['max'])) ? $values['max'] : $values[1];
			
			return ['min' => $min, 'max' => $max];
		}

		return false;
	}
	
}
