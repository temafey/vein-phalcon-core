<?php
/**
 * @namespace
 */
namespace Vein\Core\Filter;

/**
 * Interface FilterInterface
 *
 * @category    Vein\Core
 * @package     Filter
 */
interface FilterInterface
{
    /**
     * Filter value
     *
     * @param $value
     * @return mixed
     */
    public function filter($value);
}