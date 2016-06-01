<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Decorator\Form;

use Vein\Core\Crud\Decorator,
    Vein\Core\Crud\Form,
    Vein\Core\Crud\Decorator\Helper;

/**
 * Class DataTable decorator for form.
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Decorator
 */
class DataTable extends Decorator
{
    /**
     * Render an element
     *
     * @param  string $content
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
        $attribs['id'] = $element->getId();

        foreach ($helpers as $i => $helper) {
            $helpers[$i] = Helper::factory($helper, $element);
        }

        $sections = [];
        $continue = false;
        foreach ($helpers as $i => $helper) {
            $helper['createFile'] = false;
            call_user_func_array([$helper['helper'], 'init'], [$helper['element']]);
            $endTag = call_user_func([$helper['helper'], 'endTag']);
            if (call_user_func([$helper['helper'], 'createJs'])) {
                $objectName = call_user_func([$helper['helper'], 'getName']);
                $path = call_user_func_array([$helper['helper'], 'getJsFilePath'], [$objectName]);
                $path = MODULE_PATH."/dataTable/apps/".$path;
                if (!$this->_checkFile($path)) {
                    if ($endTag) {
                        $continue = false;
                    }
                    $helper['createFile'] = $path;
                } else {
                    if ($endTag) {
                        $continue = true;
                    }
                    continue;
                }
            }
            if ($endTag === false && $helper['createFile']) {
                if (!file_put_contents($helper['createFile'], call_user_func_array([$helper['helper'], '_'], [$helper['element']]))) {
                    throw new \Vein\Core\Exception("File '".$helper['createFile']."' not save");
                }
            } else {
                if ($continue) {
                    continue;
                }
                if ($endTag !== '') {
                    $key = $i;
                    $sections[$key] = [];
                    $helpers[$key]['createFile'] = $helper['createFile'];
                }
                $sections[$key][] = call_user_func_array([$helper['helper'], '_'], [$helper['element']]);
            }
        }

        foreach ($sections as $key => $fileSections) {
            $elementContent = implode('', $fileSections);
            $elementContent .= call_user_func([$helpers[$key]['helper'], 'endTag']);
            /*if (!file_put_contents($helpers[$key]['createFile'], $elementContent)) {
                throw new \Vein\Core\Exception("File '".$helpers[$key]['createFile']."' not save");
            }*/
        }

        $content .= $elementContent;

        return $content;

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
     * Return default helpers
     *
     * @return array
     */
    public function getDefaultHelpers()
    {
        $helpers = [
            'dataTable',
            'dataTable\Fields',
            'dataTable\Functions'
        ];

        return $helpers;
    }

    /**
     * Check file by path
     *
     * @param string $path
     * 
     * @return bool
     */
    protected function _checkFile($path)
    {
        $result = file_exists($path);
        if (!$result) {
            $dependencyInjectorr = dirname($path);
            if (!file_exists($dependencyInjectorr)) {
                mkdir($dependencyInjectorr, 0755, true);
            }
        }

        return $result;
    }
}