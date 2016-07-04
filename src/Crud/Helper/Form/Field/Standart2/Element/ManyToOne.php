<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Form\Field\Standart\Element;

use Vein\Core\Crud\Form as Form,
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
        $attributes = [];

        $width = $field->getWidth();
        $attributes['width'] = $width;

        return $field->getElement()->render($attributes);
    }
}