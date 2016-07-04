<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Form\Field\Volt\Element;

use Vein\Core\Crud\Grid\Filter as Filter,
    Vein\Core\Crud\Form\Field as Field;

/**
 * Class form fields helper
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Helper
 */
class ManyToOne extends Combobox
{
    public static function _(Field\ArrayToSelect $field)
    {
        $element = $field->getElement();
        
        $width = $field->getWidth();
        $element->setAttribute('width', $width);

        return $element->render();
    }
}