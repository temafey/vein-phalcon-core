<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Decorator\Grid;

use Vein\Core\Crud\Decorator,
    Vein\Core\Crud\Grid,
    Vein\Core\Crud\Decorator\Helper;

/**
 * Class DataTable decorator for grid.
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
            if (call_user_func([$helper['helper'], 'createFile'])) {
                $objectName = call_user_func([$helper['helper'], 'getName']);
                $path = call_user_func_array([$helper['helper'], 'getFilePath'], [$objectName]);
                $path = PUBLIC_PATH."/datatables/".$path;
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
        
        $content = [];
        foreach ($sections as $key => $fileSections) {
            $elementContent = implode('', $fileSections);
            $elementContent .= call_user_func([$helpers[$key]['helper'], 'endTag']);
            $content[] = $elementContent;

            /*if (empty($elementContent) || !file_put_contents($helpers[$key]['createFile'], $elementContent)) {
                throw new \Vein\Core\Exception("File '".$helpers[$key]['createFile']."' not save");
            }*/
        }

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
            'standart',
            'standart\ColumnsHead',
            'standart\Body',
            'dataTable',
            //'dataTable\Filter',
            'dataTable\Columns',
            'dataTable\Functions',
            'dataTable\Buttons'
        ];

        return $helpers;
    }

    /**
     * Check file by path
     *
     * @param string $path
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