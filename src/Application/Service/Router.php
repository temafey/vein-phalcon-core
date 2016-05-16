<?php
/**
 * @namespace
 */
namespace Vein\Core\Application\Service;

use Vein\Core\Application\Service\AbstractService;

/**
 * Class Router
 *
 * @category   Vein\Core
 * @package    Application
 * @subpackage Service
 */
class Router extends AbstractService
{
    /**
     * Initializes router system
     */
    public function init()
    {
        $dependencyInjector = $this->getDi();
        $eventsManager = $this->getEventsManager();

        $routerCacheKey = 'router_data.cache';
        $cacheData = $dependencyInjector->get('cacheData');
        $router = $cacheData->get($routerCacheKey);

        if ($this->_config->application->debug || $router === null) {

            $saveToCache = ($router === null);

            // load all controllers of all modules for routing system
            $modules = $dependencyInjector->get('modules');

            //Use the annotations router
            $defaultModule = $this->_config->application->defaultModule;
            $router = new \Phalcon\Mvc\Router\Annotations(false);
            $router->removeExtraSlashes(true);
            $router->setDefaultModule($defaultModule);
            $router->setDefaultNamespace(ucfirst($defaultModule).'\Controller');
            $router->setDefaultController("index");
            $router->setDefaultAction("index");

            $router->add('/:module/:controller/:action/:int', [
                'module' => 1,
                'controller' => 2,
                'action' => 3,
                'id' => 4
            ]);
            $router->add('/:module/:controller/:action', [
                'module' => 1,
                'controller' => 2,
                'action' => 3
            ]);

            $router->add('/:controller/:action/:int', [
                'controller' => 1,
                'action' => 2,
                'id' => 3
            ]);
            $router->add('/:controller/:action', [
                'controller' => 1,
                'action' => 2
            ]);

            $router->add('/:controller/:int', [
                'controller' => 1,
                'id' => 2
            ]);
            $router->add('/:controller', [
                'controller' => 1
            ]);

           $router->notFound([
                'module' => $defaultModule,
                'namespace' => ucfirst($defaultModule).'\Controller',
                'controller' => 'error',
                'action' => 'show404'
            ]);

            //Read the annotations from controllers
            foreach ($modules as $module => $enabled) {
                if (!$enabled) {
                    continue;
                }
                if (!file_exists($this->_config->application->modulesDir.ucfirst($module).'/Controller')) {
                    continue;
                }
                $files = scandir($this->_config->application->modulesDir.ucfirst($module).'/Controller'); // get all file names
                foreach ($files as $file) { // iterate files
                    if ($file == "." || $file == "..") {
                        continue;
                    }
                    $controller = ucfirst($module).'\Controller\\'.str_replace('Controller.php', '', $file);
                    if (strpos($file, 'Controller.php') !== false) {
                        $router->addModuleResource(strtolower($module), $controller);
                    }
                }
            }
            if ($saveToCache) {
                $cacheData->save($routerCacheKey, $router, 3600); // 30 days cache
            }
        }

        $dependencyInjector->set('router', $router);
    }
} 