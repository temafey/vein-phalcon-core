<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Filter\Field\Volt\Element;

use Vein\Core\Crud\Grid\Filter as Filter,
    Vein\Core\Crud\Grid\Filter\Field as Field;

/**
 * Class filter fields helper
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Helper
 */
class Combobox extends BaseHelper
{
    /**
     * Render combobox filter field
     *
     * @param \Vein\Core\Crud\Grid\Filter\Field $field
     *
     * @return string
     */
    public static function _(Field\ArrayToSelect $field)
    {
        $element = $field->getElement();

        $width = $field->getWidth();
        $element->setAttribute('width', $width);

        return $element->render();
    }
}