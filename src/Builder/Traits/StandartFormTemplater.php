<?php
/**
 * @namespace
 */
namespace Vein\Core\Builder\Traits;


trait StandartFormTemplater {

    public $templateStandartFormExtends = 'Form';

    public $templateSimpleUseFormStandart = [
        'Form' => 'Vein\Core\Crud\Form\Standart',
        'Vein\Core\Crud\Form\Field'
    ];

    public $templateStandartFormModulePrefix = "
    /**
     * Content managment system module router prefix
     * @var string
     */
    protected \$_modulePrefix = ADMIN_PREFIX;
";

    public $templateStandartFormModuleName = "
    /**
     * Standart module name
     * @var string
     */
    protected \$_module = '%s';
";

    public $templateStandartFormKey = "
    /**
     * Standart form key
     * @var string
     */
    protected \$_key = '%s';
";

} 