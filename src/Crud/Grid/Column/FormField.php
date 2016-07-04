<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Grid\Column;

use Vein\Core\Crud\Grid,
    Vein\Core\Crud\Container\Grid as GridContainer,
    Vein\Core\Crud\Form;
	
/**
 * Image join column
 *
 * @uses       \Vein\Core\Crud\Grid\Exception
 * @uses       \Vein\Core\Crud\Grid\Filter
 * @uses       \Vein\Core\Crud\Grid
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Grid
 */
class FormField extends Base
{	
	/**
	 * Form object for update table column.
	 * @var \Vein\Core\Crud\Form
	 */
	protected $_form = null;

	/**
	 * @var
	 */
	protected $_element;

	protected $_elementView;
	protected $_elementHelper;
	protected $_elementAttribs;
	protected $_elementName;
	protected $_elementOptions;

	/**
	 * Form element attributes
	 * @var array
	 */
	protected $_attibutes;

	/**
	 * Constructor
	 * 
	 * @param string $title
	 * @param string $name
	 * @param bool $isSortable
	 * @param array $attibutes
	 * @param int $width
	 */
	public function __construct($title, $name = null, $isSortable = true, array $attibutes = [], $width = 200)
	{
		parent::__construct($title, $name, $isSortable, false, $width);
		$this->_attibutes = $attibutes;
	}

	public function init() 
	{
		$field = (!empty($this->_name)) ? $this->_form->getFieldByName($this->_name) : $this->_form->getFieldByKey($this->_key);
		if (!$field) {
			throw new \Vein\Core\Exception('Field like '.$this->name.' does not exists in '.get_class($this->_form).' form!');
		}
		
		$field->setForm($this->_form);
		$this->_element = $field->createElement();
		if (is_array($this->_element)) {
		    $element = each($this->_element);
		    $element = $element['value'];
            $this->_elementView = $element->getView();
            $this->_elementHelper = $element->helper;
	    	$this->_elementAttribs = $element->getAttribs();
    		$this->_elementName = $element->getFullyQualifiedName ();
		    $this->_elementOptions = $element->options;
		} else {
		    $this->_elementView = $this->_element->getView ();
		    $this->_elementHelper = $this->_element->helper;
		    $this->_elementAttribs = $this->_element->getAttribs ();
		    $this->_elementName = $this->_element->getFullyQualifiedName ();
		    $this->_elementOptions = $this->_element->options;
		}

		if ($this->_element instanceof \Vein\Core\Forms\Element\Checkbox) {
			$this->_elementOptions = array ('checked' => 1, 'unChecked' => 0 );
		}
	}

	/**
	 * (non-PHPdoc)
	 * @see Crud\Grid\Column.Standart::render()
	 */
	public function render($row) 
	{
		throw new \Exception('Can\'t render');
	}

	/**
	 * Update column in database by primary key.
	 * 
	 * @param int $id
	 * @param string $value
	 */
	public function updateField($id, $value)
	{
		if ($this->_element->isValid($value)) {
			$model = $this->_form->getModel();
			$field = $this->_form->getFieldByName($this->_name);
			$field->setValue($value);
			$value = $field->getValue();
			$column = $field->getName();
			$data = array($column => $value);
			$where = $model->q($model->getPrimary()." = ?", $id);

			return $model->update($data, $where);
		}
		
		return array('valid' => false, 'errors' => $this->_element->getErrors());
	}
	
	/**
	 * Set \Vein\Core\Crud\Form class name.
	 * 
	 * @param string|\Crud\Form\Form $form
     *
     * @return \Vein\Core\Crud\Grid\Column\FormColumn
	 */
	public function setForm($form)
	{
		if (!($form instanceof Form)) {
			$form = \Tools\Registry::singleton($form);
		}
	    $this->_form = $form;
	    
	    return $this;
	}
}