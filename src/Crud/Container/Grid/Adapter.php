<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Container\Grid;

/**
 * Grid Container Adapter interface.
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Container
 */
interface Adapter
{

    /**
     * Return database model
     *
     * @return \Vein\Core\Mvc\Model
     */
    public function getModel();

    /**
     * Return database model adapter
     *
     * @return string|object
     */
    public function getAdapter();

	/**
	 * Return data array
	 * 
	 * @param mixed $dataSource
     *
     * @return array
	 */
	public function getData($dataSource);
	
	/**
	 * Return data source obejct
	 * 
	 * @return \Vein\Core\Mvc\Model\Query\Builder $dataSource
	 */
	public function getDataSource();

	/**
	 * Nulled data source object
	 *
	 * @return \Vein\Core\Crud\Container\Grid\Adapter
	 */
	public function clearDataSource();
	
	/**
	 * Return data source filter object by params
	 *
     * @return \Vein\Core\Filter\SearchFilterInterface
	 */
	public function getFilter();
	
	/**
	 * Set column to container
	 * 
	 * @param string $key
	 * @param string $name
     *
     * @return \Vein\Core\Crud\Container\Grid\Adapter
	 */
	public function setColumn($key, $name);
	
	/** 
	 * Update rows by primary id values
	 * 
	 * @param array $id
	 * @param array $data
     *
     * @return bool|array
	 */
	public function update(array $ids, array $data);
	
	/**
	 * Delete rows by primary value
	 * 
	 * @param array $ids
     *
     * @return bool
	 */
	public function delete(array $ids);
}