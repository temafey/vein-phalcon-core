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
class Phone extends BaseHelper
{
    /**
     * Render mail form field
     *
     * @param \Vein\Core\Crud\Form\Field $field
     *
     * @return string
     */
    public static function _(Field $field)
    {
        $element = $field->getElement();
        
        $element->setAttribute('data-inputmask', '"mask": "+99(999) 999-9999"');
        $element->setAttribute('data-mask', '');

        $width = $field->getWidth();
        $element->setAttribute('width', $width);

        $code = '
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-phone"></i>
                        </div>
                        ';

        $elementCode = $element->render();

        $code .= $elementCode;
        $code .= '
                    </div>';

        return $code;
    }
}