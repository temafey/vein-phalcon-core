<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Form\Field;

use Engine\Crud\Form\Field;

/**
 * Date field
 *
 * @category   Engine
 * @package    Crud
 * @subpackage Form
 */
class Date extends Field
{
    /**
     * Form element type
     * @var string
     */
    protected $_type = 'text';

    /**
     * Field value type.
     * @var string
     */
    protected $_valueType = 'date';

    /**
     * Validation start date
     * @var string
     */
    protected $_startDate;

    /**
     * Validayion end date
     * @var string
     */
    protected $_endDate;

    /**
     * Date format
     * @var string
     */
    protected $_format;

    /**
     * @param string $label
     * @param bool|string $name
     * @param string $startDate
     * @param string $endDate
     * @param string $format
     * @param string $description
     * @param bool $required
     * @param bool $notEdit
     */
    public function __construct(
        $label = null,
        $name = null,
        $startDate = null,
        $endDate = null,
        $format = 'Y-m-d H:i:s',
        $description = null,
        $width = 280,
        $required = false,
        $default = null,
        $notEdit = false
    ) {
		parent::__construct($label, $name, $description, $required, $width, $default);

        $this->_startDate = $startDate;
        $this->_endDate = $endDate;
        $this->_format = $format;
	}

    /**
     * Initialize field (used by extending classes)
     *
     * @return void
     */
    protected function _init()
    {
        parent::_init();

        if ($this->_startDate || $this->_endDate) {
            $this->_validators[] = [
                'validator' => 'Between',
                'options' => [
                    'minimum' => $this->_startDate,
                    'maximum' => $this->_endDate,
                    'messages' => "The date must be between '".$this->_startDate."' and '".$this->_endDate."'"
                ]
            ];
        }
    }

    /**
     * Return field save data
     *
     * @return array|bool
     */
    public function getSaveData()
    {
        if ($this->_notSave) {
            return false;
        }

        $value = $this->getValue();
        $date = new \DateTime($value);
        $value = $date->format('Y-m-d H:i:s');

        return ['key' => $this->getName(), 'value' => $value];
    }

    /**
     * Set form field value
     *
     * @param array|int|string $value
     * @return \Engine\Crud\Tools\FormElements
     */
    public function setValue($value)
    {
		//$value = str_replace ( "-", "/", $value );
		//$value = date ( 'm-d-Y', strtotime ( $value ) );
		$date = new \DateTime($value);
        $value = $date->format($this->_format);

		return parent::setValue($value);
	}

    /**
     * Set date format string
     *
     * @param string $format
     * @return \Engine\Crud\Grid\Column\Date
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
     * Return min date that can be set
     *
     * @return string
     */
    public function getMinValue()
    {
        return $this->_startDate;
    }

    /**
     * Return max date that can be set
     *
     * @return string
     */
    public function getMaxValue()
    {
        return $this->_endDate;
    }
}
