<?php
/**
 * @namespace
 */
namespace Vein\Core\Builder\Traits;


trait SimpleGridTemplater {

    public $templateSimpleGridFileCode = '<?php
%s

%s

%s
class %s extends %s
{
%s
}
';
    // Set $_title template
    public $templateSimpleGridTitle = "
    /**
	 * Grid title
	 * @var string
	 */
    protected \$_title = '%s';
";

    public $templateSimpleGridContainerModel = "
    /**
	 * Container model
	 * @var string
	 */
    protected \$_containerModel = '%s';
";

    public $templateSimpleGridExtends = 'Grid';

    public $templateSimpleUseGrid = [
        'Vein\Core\Crud\Grid',
        'Vein\Core\Crud\Grid\Column',
        'Vein\Core\Crud\Grid\Filter',
        'Vein\Core\Crud\Grid\Filter\Field',
        'Criteria' => 'Vein\Core\Filter\SearchFilterInterface'
    ];

    public $templateSimpleGridInitColumns = "
    /**
	 * Initialize grid columns
	 *
	 * @return void
	 */
	protected function _initColumns()
    {
		\$this->_columns = [
%s
		 ];
    }
";

    public $templateSimpleGridInitFilters = "
    /**
	 * Initialize grid filters
	 *
	 * @return void
	*/
	protected function _initFilters()
	{
		\$this->_filter = new Filter([
		    'search' => new Field\\Search('search','Search:', [
                Criteria::COLUMN_ID => Criteria::CRITERIA_EQ,
                Criteria::COLUMN_NAME => Criteria::CRITERIA_BEGINS,
                'command' => Criteria::CRITERIA_LIKE
			]),
%s
		 ], null, 'get');
    }
";
    public $templateShortGridColumn = "\t\t\t'%s' => new Column\\%s('%s'),\n";

    public $templateSimpleGridColumn = "\t\t\t'%s' => new Column\\%s('%s', '%s'),\n";

    public $templateSimpleGridComplexColumn = "\t\t\t'%s' => new Column\\%s('%s', '%s', %s),\n";

    public $templateShortGridFilterColumn = "\t\t\t'%s' => new Field\\%s('%s'),\n";

    public $templateSimpleGridFilterColumn = "\t\t\t'%s' => new Field\\%s('%s', '%s'),\n";

    public $templateSimpleGridComplexFilterColumn = "\t\t\t'%s' => new Field\\%s('%s', '%s', %s),\n";

} 