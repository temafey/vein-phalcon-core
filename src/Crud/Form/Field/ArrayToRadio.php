<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Form\Field;

/**
 * Form field
 *
 * @category   Engine
 * @package    Crud
 * @subpackage Form
 */
class ArrayToRadio extends ArrayToSelect
{
    /**
     * Element type
     * @var string
     */
	protected $_type = 'radio';

    /**
     * Null option
     * @var string|array
     */
    protected $_nullOption = false;

}
