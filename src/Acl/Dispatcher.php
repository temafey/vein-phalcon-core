<?php
/**
 * @namespace
 */
namespace Vein\Core\Acl;

/**
 * Class Dispatcher
 *
 * @category   Vein\Core
 * @package    Acl
 */
class Dispatcher
{
    use \Vein\Core\Tools\Traits\DIaware;

    const ACL_ADMIN_MODULE = 'admin';
    const ACL_ADMIN_CONTROLLER = 'area';

    /**
     * @param \Phalcon\DiInterface $dependencyInjector
     */
    public function __construct(\Phalcon\DiInterface $dependencyInjector = null)
    {
        $this->setDi($dependencyInjector);
    }

    /**
     * This action is executed before execute any action in the application
     */
    public function beforeDispatch(\Phalcon\Events\Event $event, \Phalcon\Mvc\Dispatcher $dispatcher)
    {
        // check installation
        /*if (!$this->_di->get('config')->installed) {
            $this->_di->set('installationRequired', true);
            if ($dispatcher->getControllerName() != 'install') {
                return $dispatcher->forward([
                    'module' => 'core',
                    "controller" => "install",
                    "action" => "index"
                ]);
            }
            return;
        }*/

        $module = $dispatcher->getModuleName();
        $controller = $dispatcher->getControllerName();
        $action = $dispatcher->getActionName();

        $viewer = $this->_di->get('viewer');
        $acl = $this->_di->get('acl');

        $registry = $this->_di->get('registry');
        $adminModuleName = (isset($registry->adminModule)) ? $registry->adminModule : 'admin';

        // check admin area
        if ($module == $adminModuleName) {
            if ($controller == 'admin') {
                return;
            }
            if (
                $acl->isAllowed($viewer->getRole(), \Vein\Core\Acl\Dispatcher::ACL_ADMIN_MODULE, \Vein\Core\Acl\Dispatcher::ACL_ADMIN_CONTROLLER, '*') ||
                $acl->isAllowed($viewer->getRole(), \Vein\Core\Acl\Dispatcher::ACL_ADMIN_MODULE, \Vein\Core\Acl\Dispatcher::ACL_ADMIN_CONTROLLER, 'read')
            ) {
                return;
            }
            if ($acl->isAllowed($viewer->getRole(), $module, $controller, $action, false)) {
                return;
            }
            if ($this->_di->get('request')->isAjax() == true) {
                return $dispatcher->forward([
                    "controller" => 'admin',
                    "action" => 'denied'
                ]);
            } else {
                return $dispatcher->forward([
                    "controller" => 'admin',
                    "action" => 'index'
                ]);
            }
        } else {
            if (!$acl->isAllowed($viewer->getRole(), $module, $controller, $action, true)) {
                return $dispatcher->forward([
                    "controller" => 'error',
                    "action" => 'show404'
                ]);
            }
        }
    }
}
