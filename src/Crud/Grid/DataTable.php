<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Grid;

use Vein\Core\Crud\Grid;

/**
 * Class DataTable.
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Grid
 */
abstract class DataTable extends Grid
{
    /**
     * Default decorator
     */
    const DEFAULT_DECORATOR = 'DataTable';

    /**
     * Content managment system module router prefix
     * @var string
     */
    protected $_modulePrefix = 'admin';

    /**
     * Grid params options
     */
    protected $_sortParamName = 'order';
    protected $_sortParamValue = null;

    protected $_directionParamName = null;
    protected $_directionParamValue = null;

    protected $_limitParamName = 'length';
    protected $_limitParamValue = null;

    protected $_pageParamName = 'start';
    protected $_pageParamValue = null;

    /**
     * DataTable module name
     * @var string
     */
    protected $_module;

    /**
     * DataTable grid key
     * @var string
     */
    protected $_key;

    /**
     * Grid height
     * @var int
     */
    protected $_height = 400;

    /**
     * Get grid action
     *
     * @return string
     */
    public function getModulePrefix()
    {
        return $this->_modulePrefix;
    }

    /**
     * Return module name
     *
     * @return string
     */
    public function getModuleName()
    {
        return $this->_module;
    }

    /**
     * Return grid key
     *
     * @return string
     */
    public function getKey()
    {
        return $this->_key;
    }

    /**
     * Get grid action
     *
     * @return string
     */
    public function getId()
    {
        if (!empty($this->_id)) {
            return $this->_id;
        }

        return \Phalcon\Text::camelize($this->_module).'_'.\Phalcon\Text::camelize($this->_key).'Grid';
    }

    /**
     * Get grid action
     *
     * @return string
     */
    public function getAction()
    {
        if (!empty($this->_action)) {
            return $this->_action;
        }
        return '/'.$this->_modulePrefix.'/'.$this->getModuleName().'/'.$this->getKey().'/read';
    }

    /**
     * Return grid fetching data
     *
     * @return array
     */
    public function getOriginData()
    {
        if (null === $this->_data) {
            $this->_setData();
        }

        return $this->_data;
    }

    /**
     * Return grid fetching data
     *
     * @return array
     */
    public function getData()
    {
        if (null === $this->_data) {
            $this->_setData();
        }

        return json_encode($this->_data);
    }

    /**
     * Return data with rendered values.
     *
     * @return array
     */
    public function getDataWithRenderValues()
    {
        if (null === $this->_data) {
            $this->_setData();
        }
        $data = $this->_data;
        foreach ($data['data'] as $i => $row) {
            $values = [];
            foreach ($this->_columns as $key => $column) {
                $values[$key] = $column->render($row);
            }
            $data['data'][$i] = $values;
        }

        return json_encode($data);
    }

    /**
     * Return data with column value
     *
     * @return array
     */
    public function getColumnData()
    {
        if (null === $this->_data) {
            $this->_setData();
        }
        $data = [];
        foreach ($this->_data[$this->_key] as $row) {
            $values = [];
            foreach ($this->_columns as $key => $column) {
                $values[$key] = $column->getValue($row);
            }
            $data[] = $values;
        }

        return $data;
    }

    /**
     * Set grid params
     *
     * @param array $params
     *
     * @return \Vein\Core\Crud\Grid
     */
    public function setParams(array $params)
    {
        $sort = $this->getSortParamName();
        $direction = $this->getSortDirectionParamName();
        if (isset($params[$sort])) {
            $this->_sortParamValue = $params[$sort][0]['column'];
            $this->_directionParamValue = $params[$sort][0]['dir'];
        }
        $limit = $this->getLimitParamName();
        if (isset($params[$limit])) {
            $this->_limitParamValue = $params[$limit];
        }
        $page = $this->getPageParamName();
        if (isset($params[$page])) {
            $this->_pageParamValue = floor($params[$page]/$this->getLimit())+1;
        }
        if (isset($params['search']) && $params['search']['value']) {
            $params['search'] = $params['search']['value'];
        }
        $this->_params = $params;

        return $this;
    }

    /**
     * Return current sort params
     *
     * @param bool $withFilterParams
     *
     * @return array
     */
    public function getSortParams($withFilterParams = true)
    {
        if (null !== $this->_sortParamValue) {
            $columns = array_values($this->_columns);
            if (isset($columns[$this->_sortParamValue])) {
                return $columns[$this->_sortParamValue]->getSortParams($withFilterParams);
            }
        }
        if ($withFilterParams) {
            return $this->getFilterParams();
        }

        return [];
    }

    /**
     * Get sort param
     *
     * @return string
     */
    public function getSortKey()
    {
        if (null === $this->_sortParamValue || !$this->_columns) {
            return $this->_defaultParams['sort'];
        }

        $columns = array_values($this->_columns);
        if (isset($columns[$this->_sortParamValue])) {
            return $columns[$this->_sortParamValue]->getKey();
        } else {
            return $this->_defaultParams['sort'];
        }
    }

    /**
     * Paginate data array
     *
     * @param array $data
     *
     * @return void
     */
    protected function _paginate(array $data)
    {
        $this->_data['data'] = $data['data'];
        unset($data['data']);
        $page = $data['page'];
        $limit = $data['limit'];

        if ($page == 'all' || $limit == 'all' || $limit === false) {
            $this->_data['recordsFiltered'] = count($data['data']);
            $this->_data['recordsTotal'] = count($data['data']);
            return true;
        }

        $lines = ($this->_isCountQuery) ? $data['total_items'] : $limit;
        $this->_data['recordsTotal'] = $lines;
        $this->_data['recordsFiltered'] = $lines;

        return true;
    }

    /**
     * Do something before render
     *
     * @return string
     */
    protected function _beforeRender()
    {

    }

    /**
     * Return grid width
     *
     * @return integer
     */
    public function getWidth()
    {
        $width = 20;
        foreach ($this->_columns as $column) {
            $width += $column->getWidth();
        }

        return $width;
    }

    /**
     * Return grid height
     *
     * @return integer
     */
    public function getHeight()
    {
        return $this->_height;
    }
} 