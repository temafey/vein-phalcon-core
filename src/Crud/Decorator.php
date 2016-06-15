<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud;

/**
 * Class decorator.
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Decorator
 */
abstract class Decorator
{
  /**
     * Placement constants
     */
    const APPEND  = 'APPEND';
    const PREPEND = 'PREPEND';

    /**
     * Default placement: append
     * @var string
     */
    protected $_placement = 'APPEND';

    /**
     * @var \Vein\Core\Crud\Form\Field|\Vein\Core\Crud\Form|\Vein\Core\Crud\Grid
     */
    protected $_element;

    /**
     * Decorator options
     * @var array
     */
    protected $_options = [];

    /**
     * Separator between new content and old
     * @var string
     */
    protected $_separator = PHP_EOL;

    /**
     * Constructor
     *
     * @param  array $options
     * @return void
     */
    public function __construct($options = null)
    {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

    /**
     * Set options
     *
     * @param  array $options
     * @return \Vein\Core\Crud\Decorator
     */
    public function setOptions(array $options)
    {
        $this->_options = $options;
        return $this;
    }

    /**
     * Set option
     *
     * @param  string $key
     * @param  mixed $value
     * @return \Vein\Core\Crud\Decorator
     */
    public function setOption($key, $value)
    {
        $this->_options[(string) $key] = $value;
        return $this;
    }

    /**
     * Get option
     *
     * @param  string $key
     * @return mixed
     */
    public function getOption($key)
    {
        $key = (string) $key;
        if (isset($this->_options[$key])) {
            return $this->_options[$key];
        }

        return null;
    }

    /**
     * Retrieve options
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->_options;
    }

    /**
     * Remove single option
     *
     * @param mixed $key
     * @return boolean
     */
    public function removeOption($key)
    {
        if (null !== $this->getOption($key)) {
            unset($this->_options[$key]);
            return true;
        }

        return false;
    }

    /**
     * Clear all options
     *
     * @return \Vein\Core\Crud\Decorator\Decorator
     */
    public function clearOptions()
    {
        $this->_options = [];
        return $this;
    }

    /**
     * Set current form element
     *
     * @param  \Vein\Core\Crud\Form\Field|\Egnine\Crud\Form|\Vein\Core\Crud\Grid $element
     * @return \Vein\Core\Crud\Decorator\Decorator
     * @throws \InvalidArgumentException on invalid element type
     */
    public function setElement($element)
    {
        if (
                !$element instanceof \Vein\Core\Crud\Grid
            &&  !$element instanceof \Vein\Core\Crud\Grid\Filter
            &&  !$element instanceof \Vein\Core\Crud\Form
            &&  !$element instanceof \Vein\Core\Crud\Form\Field
        ) {
            throw new \InvalidArgumentException('Invalid element type passed to decorator');
        }
        $this->_element = $element;
        
        return $this;
    }

    /**
     * Retrieve current element
     *
     * @return  \Vein\Core\Crud\Grid
     *          \Vein\Core\Crud\Grid\Filter
     *          \Vein\Core\Crud\Grid\Filter\Field
     *          \Vein\Core\Crud\Form
     *          \Vein\Core\Crud\Form\Field
     */
    public function getElement()
    {
        return $this->_element;
    }

    /**
     * Determine if decorator should append or prepend content
     *
     * @return string
     */
    public function getPlacement()
    {
        $placement = $this->_placement;
        if (null !== ($placementOpt = $this->getOption('placement'))) {
            $placementOpt = strtoupper($placementOpt);
            switch ($placementOpt) {
                case static::APPEND:
                case static::PREPEND:
                    $placement = $this->_placement = $placementOpt;
                    break;
                case false:
                    $placement = $this->_placement = null;
                    break;
                default:
                    break;
            }
            $this->removeOption('placement');
        }

        return $placement;
    }

    /**
     * Retrieve separator to use between old and new content
     *
     * @return string
     */
    public function getSeparator()
    {
        $separator = $this->_separator;
        if (null !== ($separatorOpt = $this->getOption('separator'))) {
            $separator = $this->_separator = (string) $separatorOpt;
            $this->removeOption('separator');
        }
        return $separator;
    }

    /**
     * Decorate content and/or element
     *
     * @param  string $content
     * @return string
     * @throws \RunTimeException when unimplemented
     */
    public function render($content = '')
    {
        throw new \RunTimeException('render() not implemented');
    }
}