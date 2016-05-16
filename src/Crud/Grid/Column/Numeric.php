<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Grid\Column;

/**
 * class Numeric
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Grid
 */
class Numeric extends Base
{
    /**
     * Field type.
     * @var string
     */
    protected $_type = 'int';

    /**
     * Initialize field (used by extending classes)
     *
     * @return void
     */
	protected function _init()
	{
		$this->_filters = [
			'filter' => 'float'
		];
	}

	/**
	 * Return render value
	 *
	 * @see \Vein\Core\Crud\Grid\Column::render()
	 * @param mixed $row
	 *
	 * @return integer||float
	 */
	public function render($row)
	{
		$value = parent::render($row);
		if (\Vein\Core\Tools\Strings::isFloat($value)) {
			$value = floatval($value);
		} else {
			$value = (int) $value;
		}

		return $value;
	}
}