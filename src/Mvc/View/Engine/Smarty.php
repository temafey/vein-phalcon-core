<?php
/**
 * @namespace
 */
namespace Vein\Core\Mvc\View\Engine;

use Phalcon\Mvc\View\Engine,
    Phalcon\Mvc\View\EngineInterface;

/**
 * Phalcon\Mvc\View\Engine\Smarty
 *
 * Adapter to use Smarty library as templating engine
 */
class Smarty extends Vein\Core implements Vein\CoreInterface
{

    protected $_smarty;

    protected $_params;

    /**
     * Phalcon\Mvc\View\Engine\Twig constructor
     *
     * @param \Phalcon\Mvc\ViewInterface $view
     * @param \Phalcon\DiInterface $dependencyInjector
     */
    public function __construct($view,  $dependencyInjector=null)
    {
        $this->_smarty = new \Smarty();
        $this->_smarty->template_dir = '.';
        $this->_smarty->compile_dir = SMARTY_DIR.'templates_c';
        $this->_smarty->config_dir = SMARTY_DIR.'configs';
        $this->_smarty->cache_dir = SMARTY_DIR.'cache';
        $this->_smarty->caching = false;
        $this->_smarty->debugging = true;
        parent::__construct($view, $dependencyInjector);
    }

    /**
     * Renders a view
     *
     * @param string $path
     * @param array $params
     */
    public function render($path, $params, $mustClean=null)
    {
        if (!isset($params['content'])) {
            $params['content'] = $this->_view->getContent();
        }
        foreach ($params as $key => $value) {
            $this->_smarty->assign($key, $value);
        }
        $this->_view->setContent($this->_smarty->fetch($path));
    }
    
	/**
	 * Set Smarty's options
	 *
	 * @param array $options
	 */
	public function setOptions(array $options) {
		foreach ($options as $k => $v) {
			 $this->_smarty->$k = $v;
		}
	}

}
