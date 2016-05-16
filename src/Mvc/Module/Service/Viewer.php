<?php
/**
 * @namespace
 */
namespace Vein\Core\Mvc\Module\Service;

use Vein\Core\Mvc\Module\Service\AbstractService,
    Phalcon\Mvc\Dispatcher as MvcDispatcher,
    Phalcon\Events\Manager as EventsManager,
    Phalcon\Mvc\Dispatcher\Exception as DispatchException,
    Vein\Core\Acl\Viewer as Service;

/**
 * Class Viewer
 *
 * @category   Vein\Core
 * @package    Mvc
 * @subpackage Moduler
 */
class Viewer extends AbstractService
{
    /**
     * Initializes viewer
     */
    public function register()
    {
        $dependencyInjector = $this->getDi();
        $eventsManager = $this->getEventsManager();

        $dependencyInjector->set('viewer', function () use ($dependencyInjector, $eventsManager) {
            return new Service($dependencyInjector);
        });
    }
} 