<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Grid\Filter\Field;

use Vein\Core\Crud\Grid\Filter\Field,
    Vein\Core\Filter\SearchFilterInterface as Criteria,
    Vein\Core\Crud\Container\AbstractContainer as Container;

/**
 * Grid filter field
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Grid
 */
class Geo extends Compound
{
    /**
     * Element type
     * @var string
     */
    protected $_type = 'text';

	/**
	 * Max string length
	 * @var integer
	 */
	protected $_length;

    /**
     * Filter value delimeter
     * @var string
     */
    protected $_delimeter;
	
	/**
     * Constructor
	 *
     * @param string $title
	 * @param string $name
	 * @param string $desc
	 * @param string $criteria
	 * @param int $width
	 */
	public function __construct(
        $label = null,
        $name = null,
        $desc = null,
        $criteria = Criteria::CRITERIA_EQ,
        $width = 280,
        $default = null,
        $length = 100)
	{
        parent::__construct($label, $name, $desc, $criteria);
        $this->_width = intval($width);
        if ($default !== null) {
            $this->_default = $default;
        }
		$this->_length = intval($length);
	}

	/**
     * Initialize field (used by extending classes)
     *
     * @return void
     */
	protected function _init()
	{
        parent::_init();

		$this->_filters[] = [
			'filter' => 'trim',
			'options' => []
		];
		
		$this->_validators[] = [
			'validator' => 'StringLength',
			'options' => [
				'max' => $this->_length
			]
		];
	}
	
	/**
	 * Return datasource filters
	 *
     * @param \Vein\Core\Crud\Container\AbstractContainer $container
     *
     * @return \Vein\Core\Filter\SearchFilterInterface
	 */
    public function getFilter(Container $container)
    {
		$values = $this->getValue();
		if ($values === null || $values === false || (is_string($values) && $values == '')) {
		    return false;
		}
		$filters = [];
		if (!is_array($values)) {
			$values = ($this->_delimeter) ? explode($this->_delimeter, $values) : [$values];
		}

        if (!$this->checkHashValue($values)) {
            return false;
        }

		foreach ($values as $val) {
			if (trim($val) == '' || array_search($val, $this->_exceptionsValues)) {
				continue;
			}
			$filter = $container->getFilter('search', [$this->_name => $this->_criteria], $val);
			$filter->setFilterField($this);
			$filters[] = $filter;
		}
		$filter = $container->getFilter('compound', 'OR', $filters);
		$filter->setFilterField($this);

		return $filter;
	}

    /**
     * Set filter value delimeter
     *
     * @param string  $delimeter
     *
     * @return \Vein\Core\Crud\Grid\Filter\Field\Standart
     */
    public function setDelimeter($delimeter)
    {
        $this->_delimeter = (string) $delimeter;

        return $this;
    }
}
