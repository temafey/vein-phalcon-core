<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Grid\Column;

/**
 * class Name
 *
 * @category   Engine
 * @package    Crud
 * @subpackage Grid
 */
class Name extends Base
{
    /**
     * Constructor
     *
     * @param string $title
     * @param bool $isSortable
     * @param bool $isHidden
     * @param int $width
     * @param bool $isEditable
     * @param string $fieldKey
     */
    public function __construct(
        $title,
        $isSortable = true,
        $isHidden = false,
        $width = 160,
        $isEditable = true,
        $fieldKey = null
    ) {
        $this->_title = $title;

        $this->_isSortable = (bool) $isSortable;
        $this->_isHidden = (bool) $isHidden;
        $this->_isEditable = (bool) $isEditable;
        $this->_fieldKey = $fieldKey;
        $this->_width = intval($width);
    }

    /**
     * Initialize field (used by extending classes)
     *
     * @return void
     */
	protected function _init()
	{
        parent::_init();

        $model = $this->_grid->getContainer()->getModel();
        $this->_name = $model->getNameExpr();
	}
}