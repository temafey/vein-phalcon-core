<?php
/**
 * @namespace
 */
namespace Vein\Core\Mvc\Module\Service;

use Vein\Core\Mvc\Module\Service\AbstractService,
    Vein\Core\Acl\Authorizer;

/**
 * Class Acl
 *
 * @category   Vein\Core
 * @package    Mvc
 * @subpackage Moduler
 */
class Auth extends AbstractService
{
    /**
     * Initializes acl
     */
    public function register()
    {
        $dependencyInjector = $this->getDi();
        $options = $this->_config->application->acl->toArray();

        $dependencyInjector->set('auth', function () use ($options, $dependencyInjector) {
            $adapter = new Authorizer($options, $dependencyInjector);
            return $adapter;
        });
    }
} 