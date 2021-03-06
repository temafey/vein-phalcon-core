<?php
/**
 * @namespace
 */
namespace Vein\Core\Builder\Traits;


trait ExtJsFormTemplater {

    public $templateExtJsFormExtends = 'Form';

    public $templateSimpleUseFormExtjs = [
        'Form' => 'Vein\Core\Crud\Form\Extjs',
        'Vein\Core\Crud\Form\Field'
    ];

    public $templateExtJsFormModulePrefix = "
    /**
     * Content managment system module router prefix
     * @var string
     */
    protected \$_modulePrefix = ADMIN_PREFIX;
";

    public $templateExtJsFormModuleName = "
    /**
     * Extjs module name
     * @var string
     */
    protected \$_module = '%s';
";

    public $templateExtJsFormKey = "
    /**
     * Extjs form key
     * @var string
     */
    protected \$_key = '%s';
";

} 