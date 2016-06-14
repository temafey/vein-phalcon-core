<?php
/**
 * @namespace
 */
namespace Vein\Core\Builder\Traits;


trait DataTableFormTemplater {

    public $templateDataTableFormExtends = 'Form';

    public $templateSimpleUseFormDataTable = [
        'Form' => 'Vein\Core\Crud\Form\DataTable',
        'Vein\Core\Crud\Form\Field'
    ];

    public $templateDataTableFormModulePrefix = "
    /**
     * Content managment system module router prefix
     * @var string
     */
    protected \$_modulePrefix = ADMIN_PREFIX;
";

    public $templateDataTableFormModuleName = "
    /**
     * DataTable module name
     * @var string
     */
    protected \$_module = '%s';
";

    public $templateDataTableFormKey = "
    /**
     * DataTable form key
     * @var string
     */
    protected \$_key = '%s';
";

} 