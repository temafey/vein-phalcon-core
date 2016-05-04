<?php
/**
 * @namespace
 */
namespace Vein\Core\Acl;

/**
 * Interface ViewerInterface
 *
 * @category   Module
 * @package    Core
 * @subpackage Model
 */
interface ViewerInterface
{
    /**
     * Retuirn role name
     *
     * @return string
     */
    public function getRole();
} 