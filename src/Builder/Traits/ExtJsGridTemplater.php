<?php
/**
 * Created by Slava Basko.
 * Email: basko.slava@gmail.com
 * Date: 3/14/14
 * Time: 6:48 PM
 */

namespace Vein\Core\Builder\Traits;


trait ExtJsGridTemplater {

    public $templateExtJsGridExtends = 'Grid';

    public $templateSimpleUseGridExtjs = array(
        'Grid' => 'Vein\Core\Crud\Grid\Extjs',
        'Vein\Core\Crud\Grid\Column',
        'Filter' => 'Vein\Core\Crud\Grid\Filter\Extjs',
        'Vein\Core\Crud\Grid\Filter\Field',
        'Criteria' => 'Vein\Core\Filter\SearchFilterInterface'
    );

    public $templateExtJsGridModulePrefix = "
    /**
     * Content managment system module router prefix
     * @var string
     */
    protected \$_modulePrefix = ADMIN_PREFIX;
";

    public $templateExtJsGridModuleName = "
    /**
     * Extjs module name
     * @var string
     */
    protected \$_module = '%s';
";

    public $templateExtJsGridKey = "
    /**
     * Extjs form key
     * @var string
     */
    protected \$_key = '%s';
";

} 