<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Decorator\Form;

use Vein\Core\Crud\Decorator,
	Vein\Core\Crud\Form,
    Vein\Core\Crud\Decorator\Helper,
    Vein\Core\Crud\Form\Field;

/**
 * Class Extjs decorator for grid.
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Decorator
 */
class Standart extends Decorator
{	
	/**
     * Render an element
     *
     * @param string $content
     *
     * @return string
     * @throws \UnexpectedValueException if element or view are not registered
     */
	public function render($content = '')
	{
        $element = $this->getElement();
        
        $separator = $this->getSeparator();
        $helpers = $element->getHelpers();
        if (empty($helpers)) {
        	$helpers = $this->getDefaultHelpers();
        }

        foreach ($helpers as $i => $helper) {
            $helpers[$i] = Helper::factory($helper, $element);
        }

        $sections = [];
        foreach ($helpers as $helper) {
            call_user_func_array([$helper['helper'], 'init'], [$helper['element']]);
            $sections[] = call_user_func_array([$helper['helper'], '_'], [$helper['element']]);
        }

        $elementContent = implode($separator, $sections);
        foreach (array_reverse($helpers) as $helper) {
            $elementContent .= call_user_func_array([$helper['helper'], 'endTag'], [$helper['element']]);
        }

        switch ($this->getPlacement()) {
            case self::APPEND:
                return $content . $separator . $elementContent;
            case self::PREPEND:
                return $elementContent . $separator . $content;
            default:
                return $elementContent;
        }
	}

    /**
     * Render filter form field
     *
     * @param \Vein\Core\Crud\Form\Field $field
     *
     * @return string
     */
    public function renderField(Field $field)
    {
        $helpers = $field->getHelpers();
        foreach ($helpers as $i => $helper) {
            $helpers[$i] = Helper::factory($helper, $field);
        }

        $sections = [];
        foreach ($helpers as $helper) {
            $sections[] = call_user_func_array([$helper['helper'], '_'], [$helper['element']]);
        };

        $separator = $this->getSeparator();
        $elementContent = implode($separator, $sections);

        foreach (array_reverse($helpers) as $helper) {
            $elementContent .= $sections[] = call_user_func([$helper['helper'], 'endTag', $helper['element']]);
        }

        return $elementContent;
    }
	
	/**
	 * Return default helpers
	 * 
	 * @return array
	 */
	public function getDefaultHelpers()
	{
		$helpers = [
            'standart',
            'standart\FormHead',
            'standart\Body',
            'standart\FormFoot',
		];

		return $helpers;
	}
}