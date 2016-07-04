<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Filter\Field\Standart\Element;

use Vein\Core\Crud\Grid\Filter as Filter,
    Vein\Core\Crud\Grid\Filter\Field as Field;

/**
 * Class filter fields helper
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Helper
 */
class Checkbox extends BaseHelper
{
    /**
     * Render checkbox filter field
     *
     * @param \Vein\Core\Crud\Grid\Filter\Field $field
     *
     * @return string
     */
    public static function _(Field $field)
    {
        $element = $field->getElement();

        $width = $field->getWidth();
        $element->setAttribute('width', $width);
        $element->setAttribute('class', 'form-control');

        return  $element->render();
    }
}