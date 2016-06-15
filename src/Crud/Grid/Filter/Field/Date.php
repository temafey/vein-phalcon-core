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
class Date extends Standart
{
    /**
     * Element type
     * @var string
     */
    protected $_type = 'date';

    /**
     * Initialize field (used by extending classes)
     *
     * @return void
     */
    protected function _init()
    {
        parent::_init();

        $this->_filters[] = [
            'filter' => 'trim',
            'options' => []
        ];

        $this->_validators[] = [
            'validator' => 'StringLength',
            'options' => [
                'max' => $this->_length
            ]
        ];
    }

    /**
     * Return datasource filters
     *
     * @param \Vein\Core\Crud\Container\AbstractContainer $container
     * @return \Vein\Core\Filter\SearchFilterInterface
     */
    public function getFilter(Container $container)
    {
		$value = $this->getValue();
        if (!$value) {
            return false;
        }
        $value = str_replace("-", "/", $value);
        $value = date('Y-m-d H:i:s', strtotime($value));

        if (!$this->checkHashValue($value)) {
            return false;
        }

        return $container->getFilter('standart', $this->_name, $value, $this->_criteria)->setFilterField($this);;
	}
}
