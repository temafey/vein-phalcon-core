<?php
 /**
 * @namespace
 */
namespace Vein\Core\Application\Service;

use Vein\Core\Application\Service\AbstractService;

/**
 * Class Session
 *
 * @category   Vein\Core
 * @package    Application
 * @subpackage Service
 */
class Session extends AbstractService
{
    /**
     * Initializes the session
     */
    public function init()
    {
        $dependencyInjector = $this->getDi();
        $eventsManager = $this->getEventsManager();

        if (!isset($this->_config->application->session)) {
            $sessionAdapter = $this->_getSessioneAdapter('files');
            $sessionOptions = [];
        } else {
            $sessionAdapter = $this->_getSessioneAdapter($this->_config->application->session->adapter);
            if (!$sessionAdapter) {
                throw new \Vein\Core\Exception("Session adapter '{$this->_config->application->session->adapter}' not exists!");
            }
            $sessionOptions = $this->_config->application->session->toArray();
        }
        //$session->start();

        $dependencyInjector->setShared('session', function() use ($sessionAdapter, $sessionOptions) {
            $session = new $sessionAdapter($sessionOptions);
            $session->start();
            return $session;
        });
    }

    /**
     * Return session adapter full class name
     *
     * @param string $name
     * @return string
     */
    private function _getSessioneAdapter($name)
    {
        if (class_exists($name)) {
            $adapter = $name;
        } else {
            $adapter = '\Vein\Core\Session\Adapter\\' . ucfirst($name);
            if (!class_exists($adapter)) {
                $adapter = '\Phalcon\Session\Adapter\\' . ucfirst($name);
                if (!class_exists($adapter)) {
                    return false;
                }
            }
        }

        return $adapter;
    }
} 