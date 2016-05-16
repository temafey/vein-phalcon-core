<?php
/**
 * @namespace
 */
namespace Vein\Core\Mvc\View\Vein\Core;

use Phalcon\Mvc\View\Vein\Core,
    Phalcon\Mvc\View\Vein\CoreInterface;

/**
 * Phalcon\Mvc\View\Vein\Core\Mustache
 *
 * Adapter to use Mustache library as templating engine
 */
class Mustache extends Vein\Core implements Vein\CoreInterface
{

    protected $_mustache;

    protected $_params;

    /**
     * Phalcon\Mvc\View\Vein\Core\Mustache constructor
     *
     * @param \Phalcon\Mvc\ViewInterface $view
     * @param \Phalcon\DiInterface $dependencyInjector
     */
    public function __construct($view, $dependencyInjector = null)
    {
        $this->_mustache = new \Mustache_Vein\Core();
        parent::__construct($view, $dependencyInjector);
    }

    /**
     * Renders a view
     *
     * @param string $path
     * @param array $params
     * @param bool $mustClean
     */
    public function render($path, $params, $mustClean=false)
    {
        if (!isset($params['content'])) {
            $params['content'] = $this->_view->getContent();
        }

        $content = $this->_mustache->render(file_get_contents($path), $params);
        if ($mustClean) {
            $this->_view->setContent($content);
        } else {
            echo $content;
        }
    }

}