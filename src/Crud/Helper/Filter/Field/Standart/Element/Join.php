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
class Join extends Combobox
{
    public static function _(Field\ArrayToSelect $field)
    {
        $element = $field->getElement();

        $width = $field->getWidth();
        $element->setAttribute('width', $width);

        return $element->render();
    }
}