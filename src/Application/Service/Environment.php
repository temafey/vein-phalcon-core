<?php
/**
 * @namespace
 */
namespace Vein\Core\Application\Service;

use Vein\Core\Application\Service\AbstractService;

/**
 * Class Environment
 *
 * @category   Vein\Core
 * @package    Application
 * @subpackage Service
 */
class Environment extends AbstractService
{
    /**
     * Initializes the environment
     */
    public function init()
    {
        $dependencyInjector = $this->getDi();

        set_error_handler(array('\Vein\Core\Error', 'normal'));
        register_shutdown_function(array('\Vein\Core\Error', 'shutdown'));
        set_exception_handler(array('\Vein\Core\Error', 'exception'));

        if ($this->_config->application->debug && $this->_config->application->profiler) {
            $profiler = new \Vein\Core\Profiler();
            $dependencyInjector->set('profiler', $profiler);

            $debug = new \Phalcon\Debug();
            $debug->listen();
        }
    }
} 