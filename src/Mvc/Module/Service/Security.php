<?php
/**
 * @namespace
 */
namespace Vein\Core\Mvc\Module\Service;

use Vein\Core\Mvc\Module\Service\AbstractService;

/**
 * Class Security
 *
 * @category   Vein\Core
 * @package    Mvc
 * @subpackage Moduler
 */
class Security extends AbstractService
{
    /**
     * Secutiry hashing factor
     * @var int
     */
    private $_factor = 12;

    /**
     * Initializes viewer
     */
    public function register()
    {
        $dependencyInjector = $this->getDi();
        if (isset($this->_config->application->security->workFactor)) {
            $this->_factor = $this->_config->application->security->workFactor;
        }
        $factor = $this->_factor;

        $dependencyInjector->set('security', function () use ($factor) {
            $security = new \Phalcon\Security();
            // Set the password hashing factor to $factor rounds
            $security->setWorkFactor($factor);

            return $security;
        });
    }
}
