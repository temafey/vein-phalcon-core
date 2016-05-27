<?php
/**
 * @namespace
 */
namespace Vein\Core\Mvc\View\Engine;

use Phalcon\Mvc\View\Engine,
    Phalcon\Mvc\View\EngineInterface;

/**
 * Phalcon\Mvc\View\Engine\Twig
 *
 * Adapter to use Twig library as templating engine
 */
class Twig extends Vein\Core implements Vein\CoreInterface
{

    protected $_twig;

    /**
     * Phalcon\Mvc\View\Engine\Twig constructor
     *
     * @param \Phalcon\Mvc\ViewInterface $view
     * @param \Phalcon\DiInterface $dependencyInjector
     * @param array $options TwigEnvironmentOptions
     */
    public function __construct($view,  $dependencyInjector = null, $options = [])
    {
        $loader = new \Twig_Loader_Filesystem($view->getViewsDir());
        $this->_twig = new Twig\Environment($dependencyInjector, $loader, $options);

        $this->_twig->addExtension(new Twig\CoreExtension());
        $this->registryFunctions($view);

        parent::__construct($view, $dependencyInjector);
    }

    /**
     * Registers common function in Twig
     *
     * @param \Phalcon\Mvc\ViewInterface $view
     */
    private function registryFunctions($view)
    {

        $options = array(
            'is_safe' => array('html')
        );

        $functions = array(
            new \Twig_SimpleFunction('content', function() use ($view) {
                return $view->getContent();
            }, $options),
            new \Twig_SimpleFunction('partial', function($partialPath) use ($view) {
                return $view->partial($partialPath);
            }, $options),
            new \Twig_SimpleFunction('linkTo', function($parameters, $text = null) {
                return \Phalcon\Tag::linkTo($parameters, $text);
            }, $options),
            new \Twig_SimpleFunction('textField', function($parameters) {
                return \Phalcon\Tag::textField($parameters);
            }, $options),
            new \Twig_SimpleFunction('passwordField', function($parameters) {
                return \Phalcon\Tag::passwordField($parameters);
            }, $options),
            new \Twig_SimpleFunction('hiddenField', function($parameters) {
                return \Phalcon\Tag::hiddenField($parameters);
            }, $options),
            new \Twig_SimpleFunction('fileField', function($parameters) {
                return \Phalcon\Tag::fileField($parameters);
            }, $options),
            new \Twig_SimpleFunction('checkField', function($parameters) {
                return \Phalcon\Tag::checkField($parameters);
            }, $options),
            new \Twig_SimpleFunction('radioField', function($parameters) {
                return \Phalcon\Tag::radioField($parameters);
            }, $options),
            new \Twig_SimpleFunction('submitButton', function($parameters) {
                return \Phalcon\Tag::submitButton($parameters);
            }, $options),
            new \Twig_SimpleFunction('selectStatic', function($parameters, $data = []) {
                return \Phalcon\Tag::selectStatic($parameters, $data);
            }, $options),
            new \Twig_SimpleFunction('select', function($parameters, $data = []) {
                return \Phalcon\Tag::select($parameters, $data);
            }, $options),
            new \Twig_SimpleFunction('textArea', function($parameters) {
                return \Phalcon\Tag::textArea($parameters);
            }, $options),
            new \Twig_SimpleFunction('form', function($parameters = []) {
                return \Phalcon\Tag::form($parameters);
            }, $options),
            new \Twig_SimpleFunction('endForm', function() {
                return \Phalcon\Tag::endForm();
            }, $options),
            new \Twig_SimpleFunction('getTitle', function() {
                return \Phalcon\Tag::getTitle();
            }, $options),
            new \Twig_SimpleFunction('getTitle', function() {
                return \Phalcon\Tag::getTitle();
            }, $options),
            new \Twig_SimpleFunction('stylesheetLink', function($parameters = null, $local = true) {
                return \Phalcon\Tag::stylesheetLink($parameters, $local);
            }, $options),
            new \Twig_SimpleFunction('javascriptInclude', function($parameters = null, $local = true) {
                return \Phalcon\Tag::javascriptInclude($parameters, $local);
            }, $options),
            new \Twig_SimpleFunction('image', function($parameters) {
                return \Phalcon\Tag::image($parameters);
            }, $options),
            new \Twig_SimpleFunction('friendlyTitle', function($text, $separator = null, $lowercase = true) {
                return \Phalcon\Tag::friendlyTitle($text, $separator, $lowercase);
            }, $options),
            new \Twig_SimpleFunction('getDocType', function() {
                return \Phalcon\Tag::getDocType();
            }, $options)
        );

        foreach ($functions as $function) {
            $this->_twig->addFunction($function);
        }
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
        $view = $this->_view;
        if (!isset($params['content'])) {
            $params['content'] = $view->getContent();
        }

        if (!isset($params['view'])) {
            $params['view'] = $view;
        }

        $relativePath = str_replace($view->getViewsDir(), '', $path);

        $content = $this->_twig->render($relativePath, $params);
        if ($mustClean) {
            $this->_view->setContent($content);
        } else {
            echo $content;
        }
    }
    
    /**
     * 
     * @return Twig\Environment
     */
    public function getTwig()
    {
        return $this->_twig;
    }
}
