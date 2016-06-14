<?php
/**
 * @namespace
 */
namespace Vein\Core\Builder\Traits;


trait DataTableGridTemplater {

    public $templateDataTableGridExtends = 'Grid';

    public $templateSimpleUseGridDataTable = [
        'Grid' => 'Vein\Core\Crud\Grid\DataTable',
        'Vein\Core\Crud\Grid\Column',
        'Filter' => 'Vein\Core\Crud\Grid\Filter',
        'Vein\Core\Crud\Grid\Filter\Field',
        'Criteria' => 'Vein\Core\Filter\SearchFilterInterface'
    ];

    public $templateDataTableGridModulePrefix = "
    /**
     * Content managment system module router prefix
     * @var string
     */
    protected \$_modulePrefix = ADMIN_PREFIX;
";

    public $templateDataTableGridModuleName = "
    /**
     * DataTable module name
     * @var string
     */
    protected \$_module = '%s';
";

    public $templateDataTableGridKey = "
    /**
     * DataTable form key
     * @var string
     */
    protected \$_key = '%s';
";

} 