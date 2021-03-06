<?php
/**
 * @namespace
 */
namespace Vein\Core\Builder;

use Phalcon\Db\Column,
    Vein\Core\Builder\Component,
    Vein\Core\Builder\BuilderException,
    Vein\Core\Builder\Script\Color,
    Phalcon\Text as Utils,
    Vein\Core\Builder\Traits\BasicTemplater as TBasicTemplater,
    Vein\Core\Builder\Traits\ModelTemplater as TModelTemplater,
    Vein\Core\Tools\Inflector;

/**
 * ModelBuilderComponent
 *
 * Builder to generate models
 */
class Model extends Component
{
    use TBasicTemplater, TModelTemplater;

    protected $type = self::TYPE_SIMPLE;

    public function __construct($options)
    {
        if (!isset($options['table_name']) || empty($options['table_name'])) {
            throw new BuilderException("Please, specify the model name");
        }
        $this->_options = $options;
    }

    /**
     * Returns the associated PHP type
     *
     * @param string $type
     *
     * @return string
     */
    public function getPHPType($type)
    {
        switch ($type) {
            case Column::TYPE_INTEGER:
                return 'integer';
                break;
            case Column::TYPE_DECIMAL:
            case Column::TYPE_FLOAT:
                return 'double';
                break;
            case Column::TYPE_DATE:
            case Column::TYPE_VARCHAR:
            case Column::TYPE_DATETIME:
            case Column::TYPE_CHAR:
            case Column::TYPE_TEXT:
                return 'string';
                break;
            default:
                return 'string';
                break;
        }
    }

    /**
     * Create model class
     *
     * @throws \Vein\Core\Builder\BuilderException
     * @throws \Vein\Core\Exception
     */
    public function build()
    {
        // Check name (table name)
        if (!$this->_options['table_name']) {
            throw new BuilderException("You must specify the table name");
        }

        // Get config
        $path = '';
        if (isset($this->_options['config_path'])) {
            $path = $this->_options['config_path'];
        } elseif (isset($this->_options['app_path']))  {
            $path = $this->_options['app_path'];
        } elseif (isset($this->_options['module_path']))  {
            $path = $this->_options['module_path'];
        }
        if (!$path) {
            throw new BuilderException('Config path was not set in builder options');
        }
        $config = $this->_getConfig($path);

        // build options
        $this->buildOptions($this->_options['table_name'], $config);

        // Prepare DB connection
        if (!$this->prepareDbConnection($config)) {
            return false;
        }

        // Check if table exist in database
        $table = $this->_options['table_name'];
        if ($this->_db->tableExists($table)) {
            $fields = $this->_db->describeColumns($table);
        } else {
            throw new BuilderException('Table "' . $table . '" does not exists');
        }

        // Set extender class template
        switch($this->type) {
            case self::TYPE_SIMPLE:
            case self::TYPE_EXTJS:
            default: $extends = $this->templateSimpleModelExtends;
            break;
        }


        $attributes = [];
        $belongsTo = [];
        foreach ($fields as $field) {
            $type = $this->getPHPType($field->getType());
            $attributes[] = sprintf(
                $this->templateEmptyAttribute, $type, 'public', $field->getName()
            );

            // Build belongsTo relations
            preg_match('/^(.*)\_i{1}d{1}$/', $field->getName(), $matches);
            $tableName = $matches[1];
            $tableNameTmp = $tableName;
            if (strpos($tableNameTmp, '_') === false) {
                $tableNameTmp .= '_'.$tableNameTmp;
            }
            $classTableName = str_replace(' ', '\\', Inflector::humanize(implode('_model_', explode('_', $tableNameTmp, 2))));
            if (!empty($matches)) {
                $belongsTo[] = sprintf(
                    $this->templateModelRelation,
                    'belongsTo',
                    $matches[0],
                    $classTableName,
                    'id',
                    $this->_buildRelationOptions([
                        'alias' => $this->getAlias($tableName)
                    ])
                );
            }

            if ($field->getName() == 'id' || $field->isPrimary()) {
                $this->_options['primary_column'] = $field->getName();
                $this->_options['order_expr'] = $field->getName();
            }

            if ($field->getName() == 'title' || $field->getName() == 'name') {
                $this->_options['name_expr'] = $field->getName();
                $this->_options['order_expr'] = $field->getName();
            }
        }

        $tables = $this->_db->listTables();
        foreach ($tables as $tableName) {
            foreach ($this->_db->describeReferences($tableName) as $reference) {
                if ($reference->getReferencedTable() != $table) {
                    continue;
                }

                $refColumns = $reference->getReferencedColumns();
                $columns = $reference->getColumns();
                $tableNameTmp = $tableName;
                if (strpos($tableNameTmp, '_') === false) {
                    $tableNameTmp .= '_'.$tableNameTmp;
                }
                $classTableName = str_replace(' ', '\\', Inflector::humanize(implode('_model_', explode('_', $tableNameTmp, 2))));
                $initialize[] = sprintf(
                    $this->templateModelRelation,
                    'hasMany',
                    $refColumns[0],
                    $classTableName,
                    $columns[0],
                    $this->_buildRelationOptions([
                        'alias' => Utils::camelize($tableName)
                    ])
                );
            }
        }
        $belongsToTables = [];
        foreach ($this->_db->describeReferences($table) as $reference) {
            $refColumns = $reference->getReferencedColumns();
            $columns = $reference->getColumns();

            $tableName = $reference->getReferencedTable();
            if (array_key_exists($tableName, $belongsToTables)) {
                continue;
            }
            $belongsToTables[$tableName] = 1;
            $tableNameTmp = $tableName;
            if (strpos($tableNameTmp, '_') === false) {
                $tableNameTmp .= '_'.$tableNameTmp;
            }
            $classTableName = str_replace(' ', '\\', Inflector::humanize(implode('_model_', explode('_', $tableNameTmp, 2))));

            $initialize[] = sprintf(
                $this->templateModelRelation,
                'belongsTo',
                $columns[0],
                $classTableName,
                $refColumns[0],
                $this->_buildRelationOptions([
                    'alias' => $this->getAlias($tableName)
                ])
            );
        }

        // Model::initialize() code
        $initializeCode = implode('', $initialize);
        /*if (count($belongsTo) > 0) {
            foreach ($belongsTo as $rel) {
                $initializeCode .= $rel."\n";
            }
        }*/



        // Join attributes to content
        $content = implode('', $attributes);


        // Join engine properties
        if (isset($this->_options['primary_column'])) {
            $content .= sprintf($this->templateModelPrimaryColumn, $this->_options['primary_column']);
        }


        // Join engine name_expr
        if (isset($this->_options['name_expr'])) {
            $content .= sprintf($this->templateModelDefaultTitleColumn, $this->_options['name_expr']);
        }


        // Join engine attributes
        if (isset($this->_options['attributes']) && is_array($this->_options['attributes'])) {
            $content .= sprintf($this->templateModelAttribute, $this->_options['attributes']);
        }


        // Join engine orderExpr
        if (isset($this->_options['order_expr'])) {
            $content .= sprintf($this->templateModelOrderExpr, $this->_options['order_expr']);
        }


        // Join engine orderAsc
        if (isset($this->_options['order_asc']) && is_bool($this->_options['order_asc'])) {
            $content .= sprintf($this->templateModelOrder, $this->_options['order_asc']);
        } else {
            $content .= sprintf($this->templateModelOrder, 'true');
        }


        // Join initialize code to content
        $content .= '';
        if (!empty($initializeCode)) {
            $content .= sprintf($this->templateInitialize, $initializeCode);
        }


        // Join Model::getSource() code to content
        $content .= sprintf($this->templateModelGetSource, $this->_options['table_name']);


        if (isset($this->_options['mapColumn'])) {
            $content .= $this->_genColumnMapCode($fields);
        }

        $code = sprintf(
            $this->templateClassFullStack,
            '',
            $this->_builderOptions['namespace'],
            $this->_builderOptions['use'],
            $this->_builderOptions['head'],
            $this->_builderOptions['className'],
            $extends,
            $content
        );
        file_put_contents($this->_builderOptions['path'], $code);

        print Color::success(
                'Model "' . $this->_builderOptions['className'] .
                '" was successfully created.'
            ) . PHP_EOL;

        return true;
    }

    /**
     * Builds a PHP syntax with all the options in the array
     * @param array $options
     *
     * @return string PHP syntax
     */
    private function _buildRelationOptions($options)
    {
        if (empty($options)) {
            return 'NULL';
        }

        $values = [];
        foreach ($options as $name => $val) {
            if (is_bool($val)) {
                $val = $val ? 'true':'false';
            } elseif (!is_numeric($val)) {
                $val = '\''.$val.'\'';
            }
            $values[] = sprintf('\'%s\' => %s', $name, $val);
        }

        $syntax = '['. implode(',', $values). ']';

        return $syntax;
    }

    private function  _genColumnMapCode($fields)
    {
        $template = '
    /**
     * Independent Column Mapping.
     */
    public function columnMap() {
        return [
            %s
        ];
    }
';
        $contents = [];
        foreach ($fields as $field) {
            $name = $field->getName();
            $contents[] = sprintf('\'%s\' => \'%s\'', $name, $name);
        }

        return sprintf($template, join(", \n            ", $contents));
    }

}
