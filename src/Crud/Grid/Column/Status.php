<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Grid\Column;

use Vein\Core\Crud\Grid\Column,
    Vein\Core\Crud\Grid,
    Vein\Core\Crud\Container\Grid as GridContainer,
	Phalcon\Filter;
	
/**
 * Class Text
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Grid
 */
class Status extends Collection
{
    /**
     * Field type.
     * @var string
     */
    protected $_type = 'check';

    /**
     * Constructor
     *
     * @param string $title
     * @param string $name
     * @param array $options
     * @param bool $isSortable
     * @param bool $isHidden
     * @param int $width
     * @param string $fieldKey
     */
    public function __construct(
        $title,
        $name = null,
        array $options = [],
        $isSortable = true,
        $isHidden = false,
        $width = 200,
        $isEditable = true,
        $fieldKey = null
    ) {
        parent::__construct($title, $name, $options, $isSortable, $isHidden, $width, $isEditable, $fieldKey);
    }
}