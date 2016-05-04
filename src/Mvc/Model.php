<?php
/**
 * @namespace
 */
namespace Vein\Core\Mvc;

use Engine\Mvc\Model\Query\Builder;

/**
 * Class Model
 *
 * @category    Engine
 * @package     Mvc
 */
class Model extends \Phalcon\Mvc\Model
{
    CONST ID = 'ID';
    CONST NAME = 'NAME';
    CONST JOIN_PRIMARY_KEY_PREFIX = 'primary_id';

    /**
     * Additional model constant conditions
     * @var null
     */
    protected static $_conditions = null;

    /**
     * Primary model columns
     * @var array|string
     */
    protected $_primary = null;

    /**
     * Name of column like dafault name column
     * @var string
     */
    protected $_nameExpr;

    /**
     * Model attributes (columns)
     * @var array
     */
    protected $_attributes = null;

    /**
     * Default order column
     * @var string
     */
    protected $_orderExpr = null;

    /**
     * Order is asc order direction
     * @var bool
     */
    protected $_orderAsc = false;

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param 	array $parameters
     * @return  \Phalcon\Mvc\Model\ResultsetInterface
     */
    public static function find($parameters=null)
    {
        if (!static::$_conditions) {
            return parent::find($parameters);
        }
        $conditions = static::normalizeConditions(static::$_conditions);
        if (!$parameters) {
            return parent::find($conditions);
        }
        if (!$parameters) {
            $parameters = $conditions;
        } elseif (is_string($parameters)) {
            $parameters = $conditions." AND ".$parameters;
        } else {
            if (isset($parameters['conditions'])) {
                $parameters['conditions'] = $conditions." AND ".$parameters['conditions'];
            } elseif (isset($parameters[0])) {
                $parameters[0] = $conditions." AND ".$parameters[0];
            }
        }

        return parent::find($parameters);
    }


    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param array $parameters
     * @return \Engine\Mvc\Model
     */
    /*public static function findFirst($parameters=null)
    {
        if (!static::$_conditions) {
            return parent::findFirst($parameters);
        }
        $conditions = static::normalizeConditions(static::$_conditions);
        if (!$parameters) {
            return parent::findFirst($conditions);
        }
        if (!$parameters) {
            $parameters = $conditions;
        } elseif (is_string($parameters)) {
            $parameters = $conditions." AND ".$parameters;
        } else {
            if (isset($parameters['conditions'])) {
                $parameters['conditions'] = $conditions." AND ".$parameters['conditions'];
            } elseif (isset($parameters[0])) {
                $parameters[0] = $conditions." AND ".$parameters[0];
            }
        }

        return parent::findFirst($parameters);
    }*/

    /**
     * Find records by array of ids
     *
     * @param string|array $ids
     * @return  \Phalcon\Mvc\Model\ResultsetInterface
     */
    public static function findByIds($ids)
    {
        $model = new static();
        $primary = $model->getPrimary();
        $db = $model->getWriteConnection();
        if (is_array($ids)) {
            $ids = \Engine\Tools\Strings::quote($ids);
            $credential = $primary." IN (:".$primary.":)";
            return static::find([$credential, 'bind' => [$primary => $ids]]);
        } else {
            $credential = $primary." = :".$primary.":";
            return static::findFirst([$credential, 'bind' => [$primary => $ids]]);
        }
    }

    /**
     * Find records by array of ids
     *
     * @param string $column
     * @param string|array $values
     * @return  \Phalcon\Mvc\Model\ResultsetInterface
     */
    public static function findByColumn($column, $values)
    {
        $model = new static();
        $db = $model->getWriteConnection();
        if (is_array($values)) {
            $values = \Engine\Tools\Strings::quote($values);
            $credential = $column." IN (:".$column.":)";
        } else {
            $credential = $column." = :".$column.":";
        }

        return static::find([$credential, 'bind' => [$column => $values]]);
    }

    /**
     * Normalize query conditions
     *
     * @param array|string $conditions
     * @return string
     */
    public static function normalizeConditions($conditions)
    {
        if (is_string($conditions)) {
            return $conditions;
        }
        $normalizeConditions = [];
        foreach ($conditions as $key => $condition) {
            if (is_numeric($key)) {
                $normalizeConditions[] = $condition;
                continue;
            }
            if (is_array($condition)) {
                $condition = \Engine\Tools\Strings::quote($condition);
                $condition = $key." IN (".$condition.")";
            } else {
                $condition = \Engine\Tools\Strings::quote($condition);
                $condition = $key." = ".$condition;
            }
            $normalizeConditions[] = $condition;
        }

        return implode(" AND ", $normalizeConditions);
    }

    /**
     * Return model static conditions
     *
     * @return mixed
     */
    public static function getConditions()
    {
       return static::$_conditions;
    }

    /**
     * Return table primary key.
     *
     * @return string
     */
    public function getPrimary()
    {
        if (null === $this->_primary) {
            $this->_primary =  $this->getModelsMetaData()->getPrimaryKeyAttributes($this);
        }

        return is_array($this->_primary) ? ((isset($this->_primary[1])) ? $this->_primary[1] : $this->_primary[0]) : $this->_primary;
    }

    /**
     * Return model field name
     *
     * @return string
     */
    public function getNameExpr()
    {
        $nameExpr = (!$this->_nameExpr) ? $this->getPrimary() : $this->_nameExpr;

        if (!is_array($nameExpr)) {
            return $nameExpr;
        }

        $columns = [];
        foreach ($nameExpr['columns'] as $column) {
            $columns[] = $column;
        }
        $nameExprResult = (array_key_exists('function', $nameExpr) && !empty($nameExpr['function']))
            ? $nameExpr['function'] ."(" . implode(', ',$columns).")"
            : implode(', ',$columns);

        return $nameExprResult;
    }

    /**
     * Return model attributes
     *
     * @return array
     */
    public function getAttributes()
    {
        if (null === $this->_attributes) {
            $this->_attributes = $this->getModelsMetaData()->getAttributes($this);
        }

        return $this->_attributes;
    }

    /**
     * Sets a list of attributes that must be skipped from the
     * generated INSERT/UPDATE statement
     *
     *<code>
     *
     *class Robots extends \Phalcon\Mvc\Model
     *{
     *
     *   public function initialize()
     *   {
     *       $this->skipAttributes(array('price'));
     *   }
     *
     *}
     *</code>
     *
     * @param array $attributes
     * @return \Engine\Mvc\Model
     */
    public function _skipAttributes(array $attributes)
    {
        parent::skipAttributes($attributes);
        return $this;
    }

    /**
     * Return default order column
     *
     * @return string
     */
    public function getOrderExpr()
    {
        return $this->_orderExpr;
    }

    /**
     * Return default order direction
     *
     * @return string
     */
    public function getOrderAsc()
    {
        return $this->_orderAsc;
    }

    /**
     * Create a criteria for a especific model
     *
     * @param string $alias
     * @return \Engine\Mvc\Model\Query\Builder
     */
    public function queryBuilder($alias = null)
    {
        $params = [];
        $builder = new Builder($params);
        $builder->setModel($this, $alias);
        if (static::$_conditions !== null) {
            $builder->andWhere($this->normalizeConditions(static::$_conditions));
        }

        return $builder;
    }

    /**
     * Create a criteria for a specific model
     *
     * @param \Phalcon\DiInterface $dependencyInjector
     * @return \Phalcon\Mvc\Model\Criteria
     */
    public static function query(\Phalcon\DiInterface $dependencyInjector = NULL)
    {
        $criteria = parent::query($dependencyInjector);
        if (static::$_conditions !== null) {
            $criteria->andWhere(static::normalizeConditions(static::$_conditions));
        }

        return $criteria;
    }

    /**
     * Return model relation
     *
     * @param string $refModel
     * @return \Phalcon\Mvc\Model\Relation
     */
    public function getReferenceRelation($refModel)
    {
        if (!is_object($refModel)) {
            $refName = $refModel;
            $refModel = new $refModel;
            //$adapter = $this->getReadConnectionService();
            //$refModel->setReadConnectionService($adapter);
        } else {
            $refName = get_class($refModel);
        }
        if (!$refModel instanceof \Engine\Mvc\Model) {
            throw new \Engine\Exception("Model class '$refName' does not extend Engine\Mvc\Model");
        }
        $refName = trim($refName, "\\");
        $relations = $this->getModelsManager()->getBelongsTo($this);
        foreach ($relations as $relation) {
            if (trim($relation->getReferencedModel(), "\\") == $refName) {
                return $relation;
            }
        }
        $relations = $this->getModelsManager()->getHasMany($this);
        foreach ($relations as $relation) {
            if (trim($relation->getReferencedModel(), "\\") == $refName) {
                return $relation;
            }
        }

        return false;
    }

    /**
     * Return models relation path
     *
     * @param string|array $path
     * @return array
     */
    public function getRelationPath($path)
    {
        $relationPath = [];
        if (!$path) {
            return $relationPath;
        }
        if (!is_array($path)) {
            $path = [$path];
        }
        $rule = array_shift($path);
        if ($rule instanceof \Engine\Mvc\Model) {
            $rule = get_class($rule);
        }
        if (!$relation = $this->getReferenceRelation($rule)) {
            throw new \Engine\Exception("Relation between '".get_class($this)."' and '".$rule."' not found!");
        }
        $relationPath[$rule] = $relation;
        if (!$path) {
            return $relationPath;
        }
        $refModel = $relation->getReferencedModel();
        $refModel = new $refModel;
        $adapter = $this->getReadConnectionService();
        $refModel->setConnectionService($adapter);
        $tail = $refModel->getRelationPath($path);

        return array_merge($relationPath, $tail);
    }

    /**
     * Find reference rule and return fields.
     *
     * @param string $rule
     * @return string
     */
    public function getRelationFields($refModel)
    {
        return $this->getReferenceRelation($refModel)->getFields();
    }

    /**
     * Find reference rule and return reference fields.
     *
     * @param string $rule
     * @return string
     */
    public function getReferenceFields($refModel)
    {
        return $this->getReferenceRelation($refModel)->getReferencedFields();
    }

    /**
     * Fix field value for tinyint(1) types, from integer to string
     * Executes internal hooks before save a record
     *
     * @param \Phalcon\Mvc\Model\MetadataInterface $metaData
     * @param boolean $exists
     * @param string $identityField
     * @return boolean
     */
    protected function _preSave(\Phalcon\Mvc\Model\MetadataInterface $metaData, $exists, $identityField)
    {
        $dataTypes = $metaData->getDataTypes($this);
        foreach ($dataTypes as $key => $type) {
            if ($type === \Phalcon\Db\Column::TYPE_BOOLEAN) {
                $value = $this->{$key};
                if ((int) $value === $value) {
                    $this->{$key} = (string) $value;
                }
            }
        }

        return parent::_preSave($metaData, $exists, $identityField);
    }
}