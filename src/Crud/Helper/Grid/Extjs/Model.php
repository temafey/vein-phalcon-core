<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Grid\Extjs;

use Vein\Core\Crud\Grid\Extjs as Grid,
    Vein\Core\Crud\Grid\Column;

/**
 * Class extjs grid model helper
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Helper
 */
class Model extends BaseHelper
{
    /**
     * Is create js file prototype
     * @var boolean
     */
    protected static $_createJs = true;

    /**
     * Generates a widget to show a html grid
     *
     * @param \Vein\Core\Crud\Grid\Extjs $grid
     * @return string
     */
    static public function _(Grid $grid)
    {
        $code = "
        Ext.define('".static::getGridModelName()."', {
            extend: 'Ext.data.Model',";
            $columns = [];
            $validations = [];
            $primary = false;
            foreach ($grid->getColumns() as $column) {
                if ($column instanceof Column) {
                    if ($column instanceof Column\Action) {
                        continue;
                    }
                    $type = $column->getType();
                    if (!method_exists(__CLASS__, '_'.$type)) {
                        throw new \Vein\Core\Exception("Field with type '".$type."' haven't render method in '".__CLASS__."'");
                    }
                    $columnCode = forward_static_call(['self', '_'.$type], $column);

                    //$validationCode = "{field: '".$field."', type: }";
                    /*
                     * type:
                        presence
                        length
                        inclusion
                        exclusion
                        format
                     */
                    $columns[] = $columnCode;
                    //$validations[] = $validationCode;

                    if ($column instanceof Column\Primary) {
                        $primary = $column->getKey();
                    }
                }
            }
            $code .= "
            fields: [".implode(",", $columns)."
            ],";

            $code .= "
            validations: [".implode(",", $validations)."]";

            if ($primary !== false) {
                $code .= ",
            idProperty: '".$primary."'";
            }
            $code .= "
        });";

        return $code;
    }

    /**
     * Return object name
     *
     * @return string
     */
    public static function getName()
    {
        return static::getGridModelName();
    }

    /**
     * Crud helper end tag
     *
     * @return string
     */
    static public function endTag()
    {
        return false;
    }

    /**
     * Render string model column type
     *
     * @param \Vein\Core\Crud\Grid\Column $column
     * @return string
     */
    public static function _string(Column $column)
    {
        $field = $column->getKey();

        $columnCode = "
                    {
                        name: '".$field."',
                        type: 'string'
                    }";

        return $columnCode;
    }

    /**
     * Render date model column type
     *
     * @param \Vein\Core\Crud\Grid\Column $column
     * @return string
     */
    public static function _date(Column\Date $column)
    {
        $field = $column->getKey();
        $format = $column->getFormat();
        $columnCode = "
                    {
                        name: '".$field."',
                        type: 'date',
                        dateFormat: '".$format."',
                    }";

        return $columnCode;
    }

    /**
     * Render collection column type
     *
     * @param \Vein\Core\Crud\Grid\Column $column
     * @return string
     */
    public static function _collection(Column\Collection $column)
    {
        return self::_string($column);
    }

    /**
     * Render checkbox column type
     *
     * @param \Vein\Core\Crud\Grid\Column $column
     * @return string
     */
    public static function _check(Column\Status $column)
    {
        return self::_string($column);
    }

    /**
     * Render numeric column type
     *
     * @param \Vein\Core\Crud\Grid\Column $column
     * @return string
     */
    public static function _int(Column\Numeric $column)
    {
        return self::_string($column);
    }

    /**
     * Render image column type
     *
     * @param \Vein\Core\Crud\Grid\Column $column
     * @return string
     */
    public static function _image(Column\Image $column)
    {
        return self::_string($column);
    }

    /**
     * Render file column type
     *
     * @param \Vein\Core\Crud\Grid\Column $column
     * @return string
     */
    public static function _file(Column\Numeric $column)
    {
        return self::_string($column);
    }



    /**
     * Render collection column type
     *
     * @param \Vein\Core\Crud\Grid\Column $column
     * @return string
     */
    public static function _action(Column\Action $column)
    {

    }

}