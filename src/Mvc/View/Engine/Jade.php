<?php
/**
 * @namespace
 */
namespace Vein\Core\Mvc\View\Engine;

use Phalcon\Mvc\View\Engine,
    Phalcon\Mvc\View\EngineInterface;

/**
 * Jade
 *
 * Adapter to use Jade library as templating engine
 */
class Jade extends Engine implements EngineInterface
{

    protected $_jade;
    /**
     * Adapter constructor
     *
     * @param \Phalcon\Mvc\View $view
     * @param \Phalcon\DI $di
     * @param array $options
     */
    public function __construct($view, $di, $options = array())
    {
        //Initialize here the adapter
        parent::__construct($view, $di);
        $this->_jade = new \Jade\Jade($options);
    }
    /**
     * Renders a view using the template engine
     *
     * @param string $path
     * @param array $params
     */
    public function render($path, $params, $mustClean = false)
    {
        $content = $this->_jade->render($path, $params);
        if($mustClean) {
            $this->_view->setContent($content);
        } else {
            echo $content;
        }
    }
}