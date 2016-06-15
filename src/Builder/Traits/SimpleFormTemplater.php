<?php
/**
 * @namespace
 */
namespace Vein\Core\Builder\Traits;


trait SimpleFormTemplater {

    public $templateSimpleFormExtends = 'Form';

    public $templateSimpleUseForm = [
        'Vein\Core\Crud\Form',
        'Vein\Core\Crud\Form\Field'
    ];

    public $templateSimpleFormTitle = "
    /**
     * Form title
     * @var string
     */
    protected \$_title = '%s';
";

    public $templateSimpleFormContainerModel = "
    /**
	 * Container model
	 * @var string
	 */
    protected \$_containerModel = '%s';
";

    public $templateSimpleFormAction = "
    protected \$_action = '%s';
";

    public $templateSimpleFormInitFields = "
    /**
     * Initialize form fields
     *
     * @return void
     */
    protected function _initFields()
    {
        \$this->_fields = [
%s
        ];
    }
";
    public $templateShortFormSimpleField = "\t\t\t'%s' => new Field\\%s('%s'),\n";

    public $templateSimpleFormSimpleField = "\t\t\t'%s' => new Field\\%s('%s', '%s'),\n";

    public $templateSimpleFormComplexField = "\t\t\t'%s' => new Field\\%s('%s', '%s', %s),\n";

} 