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
class Numeric extends BaseHelper
{
    /**
     * Render number filter field
     *
     * @param \Vein\Core\Crud\Grid\Filter\Field $field
     *
     * @return string
     */
    public static function _(Field\Numeric $field)
    {
        $element = $field->getElement();

        $element->setAttribute('type', 'number');

        $width = $field->getWidth();
        $element->setAttribute('width', $width);

        return $element->render();
    }
}