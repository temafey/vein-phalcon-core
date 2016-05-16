<?php
/**
 * @namespace
 */
namespace Vein\Core\Mvc\Module\Service;

use Vein\Core\Mvc\Module\Service\AbstractService,
    Phalcon\Mvc\Dispatcher as MvcDispatcher,
    Phalcon\Events\Manager as EventsManager,
    Phalcon\Mvc\Dispatcher\Exception as DispatchException;

/**
 * Class Acl
 *
 * @category   Vein\Core
 * @package    Mvc
 * @subpackage Moduler
 */
class Acl extends AbstractService
{
    /**
     * Initializes acl
     */
    public function register()
    {
        $dependencyInjector = $this->getDi();
        $eventsManager = $this->getEventsManager();

        $dependencyInjector->set('acl', function () use ($dependencyInjector) {
            $acl = new \Vein\Core\Acl\Service($dependencyInjector);
            return $acl;
        });

        $options = $this->_config->application->acl->toArray();
        $aclAdapter = $this->_getAclAdapter($options['adapter']);
        $dependencyInjector->set('aclAdapter', function () use ($aclAdapter, $options, $dependencyInjector) {
            if (!$aclAdapter) {
                throw new \Vein\Core\Exception("Acl adapter '{$options['adapter']}' not exists!");
            }
            $adapter = new $aclAdapter($options, $dependencyInjector);
            return $adapter;
        });

        $aclDispatcher = new \Vein\Core\Acl\Dispatcher($dependencyInjector);
        $eventsManager->attach('dispatch:beforeDispatch', $aclDispatcher);

        if (isset($options['adminModule'])) {
            $registry = $dependencyInjector->get('registry');
            $registry->adminModule = $options['adminModule'];
        }
    }

    /**
     * Return acl adapter full class name
     *
     * @param string $name
     * @return string
     */
    protected function _getAclAdapter($name)
    {
        $adapter = '\Vein\Core\Acl\Adapter\\'.ucfirst($name);
        if (!class_exists($adapter)) {
            return false;
        }

        return $adapter;
    }
} 