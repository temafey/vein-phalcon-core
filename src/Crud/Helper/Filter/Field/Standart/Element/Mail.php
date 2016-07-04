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
class Mail extends BaseHelper
{
    /**
     * Render mail filter field
     *
     * @param \Vein\Core\Crud\Grid\Filter\Field $field
     *
     * @return string
     */
    public static function _(Field $field)
    {
        $element = $field->getElement();

        $element->setAttribute('type', 'email');

        $width = $field->getWidth();
        $element->setAttribute('width', $width);

        $code = '
                        <div class="input-group-addon">
                            <i class="fa fa-envelope"></i>
                        </div>
                        ';

        $elementCode = $element->render();

        $code .= $elementCode;

        return $code;
    }
}