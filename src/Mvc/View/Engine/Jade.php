<?php
/**
 * @namespace
 */
namespace Vein\Core\Mvc\View\Vein\Core;

use Phalcon\Mvc\View,
    Phalcon\Mvc\View\Vein\Core,
    Phalcon\Mvc\View\Vein\CoreInterface;

/**
 * Jade
 *
 * Adapter to use Jade library as templating engine
 */
class Jade extends Vein\Core implements Vein\CoreInterface
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
        $view->setRenderLevel(View::LEVEL_ACTION_VIEW);
        parent::__construct($view, $di);
        $this->_jade = new \Jade\Jade($options);
    }
    /**
     * Renders a view using the template engine
     *
     * @param string $path
     * @param array $params
     * @param bool $mustClean
     *
     * @return void
     */
    public function render($path, $params, $mustClean = false)
    {
        if (is_null($params)) {
            $params= [];
        }
        $content = $this->_jade->render($path, $params);
        if($mustClean) {
            $this->_view->setContent($content);
        } else {
            echo $content;
        }
    }
}