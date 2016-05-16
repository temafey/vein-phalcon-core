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
class InArray extends Standart
{
    /**
     * Values delimiter
     * @var string
     */
    protected $_delimiter;

    /**
     * Constructor
     *
     * @param string $label
     * @param string $name
     * @param string $criteria
     * @param string $delimiter
     */
    public function __construct(
        $label = null,
        $name = null,
        $desc = null,
        $criteria = Criteria::CRITERIA_IN,
        $delimiter = ','
    ) {
        $this->_delimiter = $delimiter;
        parent::__construct($label, $name, $desc, $criteria);
    }

    /**
     * Return datasource filters
     *
     * @param \Vein\Core\Crud\Container\AbstractContainer $container
     * @return \Vein\Core\Filter\SearchFilterInterface
     */
    public function getFilter(Container $container)
    {
        $values = $this->getValue();
        if ($values === false || (is_string($values) && trim($values) == '')) {
            return false;
        }

        if (null !== $values && !is_array($values)) {
            $values = explode($this->_delimiter, $values);
        }

        if (!$this->checkHashValue($values)) {
            return false;
        }

        return $container->getFilter('in', $this->_name, $values, $this->_criteria)->setFilterField($this);
		
    }
}
