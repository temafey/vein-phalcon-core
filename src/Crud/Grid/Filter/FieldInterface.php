<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Grid\Filter;

/**
 * Interface of grid filter field
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Grid
 */
interface FieldInterface
{
	/**
	 * Apply field filter to grid dataSource object
	 * 
	 * @param mixed $dataSource
     * @param \Vein\Core\Crud\Container\AbstractContainer $container
     *
     * @return \Vein\Core\Crud\Grid\Filter\FieldInterface
	 */
	public function applyFilter($dataSource, \Vein\Core\Crud\Container\AbstractContainer $container);

    /**
     * Set field value
     *
     * @param string|integer|array $value
     */
    public function setValue($value);
	
	/**
	 * Return field key
	 * 
	 * @return string
	 */
	public function getKey();
	
	/**
	 * Return field name
	 * 
	 * @return string
	 */
	public function getName();

    /**
     * Return phalcon form element
     *
     * @return \Phalcon\Forms\Element
     */
    public function getElement();

    /**
     * Update filter field
     *
     * @return mixed
     */
    public function updateField();
}