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
     * Triggered after entering in the dispatch loop.
     * At this point the dispatcher don’t know if the controller or the actions to be executed exist.
     * The Dispatcher only knows the information passed by the Router.
     *
     * @param \Phalcon\Events\Event $event
     * @param \Phalcon\Mvc\Dispatcher $dispatcher
     * @return boolean
     */
    public function beforeDispatch(\Phalcon\Events\Event $event, \Phalcon\Mvc\Dispatcher $dispatcher)
    {
        // check installation
        /*if (!$this->_di->get('config')->installed) {
            $this->_di->set('installationRequired', true);
            if ($dispatcher->getControllerName() != 'install') {
                return $dispatcher->forward([
                    'module' => 'core',
                    'controller' => 'install',
                    'action' => 'index'
                ]);
            }
            return;
        }*/

        $class = $dispatcher->getControllerClass();
        $module = $dispatcher->getModuleName();
        $controller = $dispatcher->getControllerName();
        $action = $dispatcher->getActionName();

        if ($this->_checkAccessFromAnnotations($class, $action)) {
            return;
        }

        /**
         * @var \Vein\Core\Acl\Viewer $viewer
         */
        $viewer = $this->_di->get('viewer');

        /**
         * @var \Vein\Core\Acl\Service $acl
         */
        $acl = $this->_di->get('acl');

        /**
         * @var \Phalcon\Registry $registry
         */
        $registry = $this->_di->get('registry');

        $adminModuleName = (isset($registry->adminModule)) ? $registry->adminModule : 'admin';

        // check admin area
        if ($module === $adminModuleName) {
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
                    'controller' => 'login',
                    'action' => 'denied'
                ]);
            } else {
                return $dispatcher->forward([
                    'controller' => 'login',
                    'action' => 'login'
                ]);
            }
        } else {
            if (!$acl->isAllowed($viewer->getRole(), $module, $controller, $action, true)) {
                return $dispatcher->forward([
                    'controller' => 'error',
                    'action' => 'show404'
                ]);
            }
        }
    }



    /**
     * Check access to controllers action from annotation
     *
     * @param string $class
     * @param string $action
     *
     * @return bool
     */
    private function _checkAccessFromAnnotations($class, $action)
    {
        if (!$this->getDi()->has('annotations')) {
            return false;
        }
        $annotations = $this->getDi()->get('annotations');

        $method = $action.'Action';
        //Parse the annotations in the method currently executed
        $annotations = $annotations->getMethod($class, $method);

        if ($annotations->has('Access')) {
            //The method has the annotation 'Cache'
            $annotation = $annotations->get('Access');
            $argument = $annotation->getArgument(0);
            //Check if there is an user defined cache key
            if ($argument && $argument == 'allowed') {
                return true;
            }
            //Check if there is an user defined cache key
            if ($argument && $argument == 'denied') {
                return false;
            }
        }

        return false;
    }
}
