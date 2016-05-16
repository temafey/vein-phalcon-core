<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Grid\Column;

use Vein\Core\Crud\Grid;
	
/**
 * Standart column
 *
 * @uses       \Vein\Core\Crud\Grid\Exception
 * @uses       \Vein\Core\Crud\Grid\Filter
 * @uses       \Vein\Core\Crud\Grid
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Grid
 */
class Date extends Base
{
    /**
     * Column type.
     * @var string
     */
    protected $_type = 'date';

    /**
     * Sort direction
     * @var string
     */
    protected $_sortDirection = Grid::DIRECTION_DESC;

    /**
     * Date format
     * @var string
     */
    protected $_format;


    /**
     * Constructor
     *
     * @param string $title
     * @param string $name
     * @param bool $isSortable
     * @param string $format
     * @param bool $isHidden
     * @param int $width
     */
    public function __construct(
        $title,
        $name = null,
        $isSortable = true,
        $format = 'Y-m-d H:i:s',
        $isHidden = false,
        $width = 160,
        $isEditable = true,
        $fieldKey = null
    ) {
        parent::__construct($title, $name, $isSortable, $isHidden, $width, $isEditable, $fieldKey);
        $this->_format = $format;
    }

    /**
     * Set date format string
     *
     * @param string $format
     * @return \Vein\Core\Crud\Grid\Column\Date
     */
    public function setFormat($format)
    {
        $this->_format = $format;
        return $this;
    }

    /**
     * Return date format string
     *
     * @return string
     */
    public function getFormat()
    {
        return $this->_format;
    }

    /**
     * Return render value
     *
     * @param mixed $row
     * @return string
     */
	public function render($row)
	{
        if (array_key_exists($this->_key, $row)) {
            $value = $row[$this->_key];
        } else {
            if ($this->_strict) {
                throw new \Vein\Core\Exception("Key '{$this->_key}' not exists in grid data row!");
            } else{
                return null;
            }
        }
        $value = $this->filter($value);
		$timestamp = strtotime($value);

		return date($this->_format, $timestamp);
	}
}