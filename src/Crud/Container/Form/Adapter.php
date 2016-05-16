<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Container\Form;

/**
 * Form Container Adapter interface.
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Container
 */
interface Adapter
{
		
	/**
	 * Return data source obejct
	 * 
	 * @return mixed $dataSource
	 */
	public function getDataSource();
	
	/**
	 * Return data array
	 * 
	 * @param int $id
	 * @return array
	 */
	public function loadData($id);
	
	/**
	 * Insert new item
	 * 
	 * @param array $data
	 * @return integer
	 */
	public function insert(array $data);
	
	/**
	 * Update item
	 * 
	 * @param array $data
	 * @param int $id
	 * @return bool
	 */
	public function update($id, array $data);
	
	/**
	 * Delete items
	 * 
	 * @param array|string|integer $id
	 * @return bool
	 */
	public function delete($ids);
}