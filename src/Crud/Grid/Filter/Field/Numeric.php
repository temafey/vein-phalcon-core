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
class Numeric extends Standart
{
    /**
     * Field value data type
     * @var string
     */
    protected $_valueType = self::VALUE_TYPE_INT;

	/**
     * Initialize field (used by extending classes)
     *
     * @return void
     */
	protected function _init()
	{
		parent::_init();
		
		$this->_validators[] = [
            'Numericality'
        ];
	}
}
