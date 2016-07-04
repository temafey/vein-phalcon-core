<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Form\Field;

use Vein\Core\Crud\Form\Field;

/**
 * Submit Form field
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Grid
 */
class Submit extends Field
{
	protected $_type = 'submit';
	
	/**
     * Constructor
	 *
	 * @param string $title
	 * @param int $width
	 */
	public function __construct($label = null, $width = 60)
	{
        $this->_value = $label;
        $this->_width = intval($width);
	}

	/**
     * Initialize field (used by extending classes)
     *
     * @return void
     */
	protected function _init()
	{
	}

	/**
	 * Return field save data
	 *
	 * @return bool
	 */
	public function getSaveData()
	{
		return false;
	}
}
