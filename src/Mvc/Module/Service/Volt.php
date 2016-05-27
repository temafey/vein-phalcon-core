<?php
/**
 * @namespace
 */
namespace Vein\Core\Mvc\Module\Service;

use Vein\Core\Mvc\Module\Service\AbstractService,
    \Phalcon\Mvc\View\Vein\Core\Volt as ViewVein\Core;

/**
 * Class Volt
 *
 * @category   Vein\Core
 * @package    Mvc
 * @subpackage Moduler
 */
class Volt extends AbstractService
{
    /**
     * Initializes Volt engine
     */
    public function register()
    {
        $dependencyInjector = $this->getDi();
        $eventsManager = $this->getEventsManager();

        $config = $this->_config;

        $dependencyInjector->set('viewVein\Core', function ($view, $dependencyInjector) use ($config) {
            $volt = new ViewVein\Core($view, $dependencyInjector);
            $volt->setOptions([
                "compiledPath" => $config->application->view->compiledPath,
                "compiledExtension" => $config->application->view->compiledExtension,
                'compiledSeparator' => $config->application->view->compiledSeparator,
                'compileAlways' => $config->application->view->compileAlways
            ]);

            $compiler = $volt->getCompiler();
            $compiler->addFilter('dump', function ($resolvedArgs) {
                return 'var_dump('.$resolvedArgs.')';
            });

            return $volt;
        });
    }
} 