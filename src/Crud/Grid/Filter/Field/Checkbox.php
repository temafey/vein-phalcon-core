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
class Checkbox extends Standart
{
    /**
     * Field value data type
     * @var string
     */
    protected $_valueType = self::VALUE_TYPE_INT;

    /**
     * Element type
     * @var string
     */
    protected $_type = 'check';

    /**
     * Default field value
     * @var mixed
     */
    protected $_value = 1;

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
			return parent::getFilter($container);
		}

		return false;
	}

    /**
     * Update field
     *
     * @return void
     */
    public function updateField()
    {
        $this->_element->getAttributes();
        //$this->_element->setDefault($this->_default);
    }
}