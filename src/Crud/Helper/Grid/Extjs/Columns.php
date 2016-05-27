<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Grid\Extjs;

use Vein\Core\Crud\Grid\Extjs as Grid,
    Vein\Core\Crud\Grid\Column,
    Vein\Core\Crud\Form\Field,
    Vein\Core\Crud\Helper\Form\Extjs\BaseHelper as FieldHelper;

/**
 * Class grid columns helper
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Helper
 */
class Columns extends BaseHelper
{
	/**
	 * Generates grid columns object
	 *
	 * @param \Vein\Core\Crud\Grid\Extjs $grid
	 * @return string
	 */
	static public function _(Grid $grid)
	{
        $code = "
            columnsGet: function() {
                return [";

        $columns = [];
        foreach ($grid->getColumns() as $column) {
            if ($column instanceof Column) {
                $type = $column->getType();
                /*if (!method_exists(__CLASS__, '_'.$type)) {
                    throw new \Vein\Core\Exception("Field with type '".$type."' haven't render method in '".__CLASS__."'");
                }*/
                switch ($type) {
                    case 'image':
                    case 'check':
                    case 'action':
                        $columnCode = forward_static_call(['static', '_'.$type], $column);
                        break;
                    default:
                        $columnCode = forward_static_call(['static', '_column'], $column);
                        break;
                }
                $columns[] = $columnCode;
            }
        }

        $code .= implode(",", $columns);

        $code .= "
                ]
            },
            ";
        
        return $code;
	}

    /**
     * Render grid colum
     *
     * @param \Vein\Core\Crud\Grid\Column $column
     * @return string
     */
    public static function _column(Column $column)
    {
        $columnCode = [];
        $columnCode[] = "text: '".$column->getTitle()."'";
        $columnCode[] = "dataIndex: '".$column->getKey()."'";
        $columnCode[] = "width: ".$column->getWidth();
        if ($column->isSortable()) {
            $columnCode[] = "sortable: true";
        }
        if ($column->isHidden()) {
            $columnCode[] = "hidden: true";
        } elseif ($column->isEditable()) {
            $field = $column->getField();
            if (!$field instanceof Field) {
                throw new \Vein\Core\Exception("Form field for column '".$column->getKey()."' does not exist");
            }
            if ($field instanceof Field\ArrayToSelect) {
                $field->setAttrib("autoLoad", true);
            }
            $field->setLabel(false);
            $field->setWidth(false);
            $field->setDesc(false);
            $fieldCode = "field:";
            $fieldCode .= FieldHelper::renderField($field, $column);
            $columnCode[] = $fieldCode;
        }

        return forward_static_call(['static', '_implode'], $columnCode);
    }

    /**
     * Render grid colum
     *
     * @param \Vein\Core\Crud\Grid\Column $column
     * @return string
     */
    public static function _image(Column $column)
    {
        $columnCode = [];
        $columnCode[] = "text: '".$column->getTitle()."'";
        $columnCode[] = "dataIndex: '".$column->getKey()."'";
        $columnCode[] = "width: ".$column->getWidth();
        if ($column->isSortable()) {
            $columnCode[] = "sortable: true";
        }
        if ($column->isHidden()) {
            $columnCode[] = "hidden: true";
        } elseif ($column->isEditable()) {
            /*$field = $column->getField();
            $field->setLabel(false);
            $field->setWidth(false);
            $field->setDesc(false);
            $fieldCode = "field:";
            $fieldCode .= FieldHelper::renderField($field);
            $columnCode[] = $fieldCode;*/
        }

        return forward_static_call(['static', '_implode'], $columnCode);
    }

    /**
     * Render string model column type
     *
     * @param \Vein\Core\Crud\Grid\Column $column
     * @return string
     */
    public static function _string(Column $column)
    {
        $columnCode = [];
        $columnCode[] = "text: '".$column->getTitle()."'";
        $columnCode[] = "dataIndex: '".$column->getKey()."'";
        $columnCode[] = "width: ".$column->getWidth();
        if ($column->isSortable()) {
            $columnCode[] = "sortable: true";
        }
        if ($column->isHidden()) {
            $columnCode[] = "hidden: true";
        }
        if ($column->isEditable()) {
            $columnCode[] = "field: 'textfield'";
        }

        return forward_static_call(['static', '_implode'], $columnCode);
    }

    /**
     * Render date column type
     *
     * @param \Vein\Core\Crud\Grid\Column $column
     * @return string
     */
    public static function _date(Column\Date $column)
    {
        $columnCode = [];
        $columnCode[] = "text: '".$column->getTitle()."'";
        $columnCode[] = "dataIndex: '".$column->getKey()."'";
        $columnCode[] = "width: ".$column->getWidth();
        if ($column->isSortable()) {
            $columnCode[] = "sortable: true";
        }
        if ($column->isHidden()) {
            $columnCode[] = "hidden: true";
        }
        if ($column->isEditable()) {
            $field = $column->getField();
            $format = $field->getFormat();
            $minValue = $field->getMinValue();
            $maxValue = $field->getMaxValue();
            $dependencyInjectorsabledDays = false;
            $dependencyInjectorsabledDaysText = false;

            $fieldCode = "field: {
                    xtype: 'datefield',
                    ";
            $fieldCode .= "format: '".$format."'";
            if ($minValue !== null && $minValue !== false) {
                $fieldCode .= ",
                    minValue: '".$minValue."'";
            }
            if ($maxValue !== null && $maxValue !== false) {
                $fieldCode .= ",
                    maxValue: '".$maxValue."' ";
            }
            if ($dependencyInjectorsabledDays !== null && $dependencyInjectorsabledDays !== false) {
                    $fieldCode .= ",
                    disabledDays: '".$dependencyInjectorsabledDays."'";
            }
            if ($dependencyInjectorsabledDaysText !== null && $dependencyInjectorsabledDaysText !== false) {
                        $fieldCode .= ",
                    disabledDaysText: '".$dependencyInjectorsabledDaysText."' ";
            }
            $fieldCode .= "
                }";
            $columnCode[] = $fieldCode;
        }

        return forward_static_call(['static', '_implode'], $columnCode);
    }

    /**
     * Render collection column type
     *
     * @param \Vein\Core\Crud\Grid\Column $column
     * @return string
     */
    public static function _collection(Column\Collection $column)
    {
        $columnCode = [];
        $columnCode[] = "text: '".$column->getTitle()."'";
        $columnCode[] = "dataIndex: '".$column->getKey()."'";
        $columnCode[] = "width: ".$column->getWidth();
        if ($column->isSortable()) {
            $columnCode[] = "sortable: true";
        }
        if ($column->isHidden()) {
            $columnCode[] = "hidden: true";
        }
        if ($column->isEditable()) {
            $field = $column->getField();
            $options = \Vein\Core\Tools\Arrays::assocToArray($field->getOptions());
            $columnCode[] = "field: {
                    xtype: 'combobox',
                    typeAhead: true,
                    triggerAction: 'all',
                    selectOnTab: true,
                    store: ".json_encode($options).",
                    lazyRender: true,
                    listClass: 'x-combo-list-small'
                }";
        }

        return forward_static_call(['static', '_implode'], $columnCode);
    }

    /**
     * Render collection column type
     *
     * @param \Vein\Core\Crud\Grid\Column $column
     * @return string
     */
    public static function _check(Column\Status $column)
    {
        $columnCode = [];
        $columnCode[] = "xtype: 'checkcolumn'";
        $columnCode[] = "header: '".$column->getTitle()."'";
        $columnCode[] = "dataIndex: '".$column->getKey()."'";
        $columnCode[] = "stopSelection: false";
        if ($column->isSortable()) {
            $columnCode[] = "sortable: true";
        }
        $columnCode[] = "width: ".$column->getWidth();

        return forward_static_call(['static', '_implode'], $columnCode);
    }

    /**
     * Render date column type
     *
     * @param \Vein\Core\Crud\Grid\Column $column
     * @return string
     */
    public static function _int(Column\Numeric $column)
    {
        $columnCode = [];
        $columnCode[] = "width: ".$column->getWidth();
        $columnCode[] = "align: 'right'";
        if ($column->isSortable()) {
            $columnCode[] = "sortable: true";
        }
        if ($column->isHidden()) {
            $columnCode[] = "hidden: true";
        }
        $columnCode[] = "text: '".$column->getTitle()."'";
        $columnCode[] = "dataIndex: '".$column->getKey()."'";
        if ($column->isEditable()) {
            $field = $column->getField();
            $minValue = $field->getMinValue();
            $maxValue = $field->getMaxValue();

            $fieldCode = "field: {
                    xtype: 'numberfield',
                    allowBlank: false,
                    ";
            if ($minValue !== null && $minValue !== false) {
                $fieldCode .= ",
                    minValue: '".$minValue."'";
            }
            if ($maxValue !== null && $maxValue !== false) {
                $fieldCode .= ",
                    maxValue: '".$maxValue."' ";
            }
            $fieldCode .= "
                }";
            $columnCode[] = $fieldCode;
        }

        return forward_static_call(['static', '_implode'], $columnCode);
    }

    /**
     * Render collection column type
     *
     * @param \Vein\Core\Crud\Grid\Column $column
     * @return string
     */
    public static function _action(Column\Action $column)
    {
        $columnCode = [];
        $columnCode[] = "xtype: 'actioncolumn'";
        $columnCode[] = "stopSelection: false";
        $columnCode[] = "sortable: false";
        $columnCode[] = "menuDisabled: true";
        $columnCode[] = "width: ".$column->getWidth();


        $items = [];
        foreach ($column->getItems() as $item) {
            $icon = $item['icon'];
            if (isset($item['name'])) {
                $tooltip = $item['name'];
            } elseif ($item['title']) {
                $tooltip = $item['title'];
            } elseif ($item['tooltip']) {
                $tooltip = $item['tooltip'];
            }
            if (isset($item['template'])) {
                $handler = $item['tempalte'];
            } elseif (isset($item['handler'])) {
                $handler = $item['handler'];
            } elseif (isset($item['function'])) {
                $handler = $item['function'];
            }
            $code = "{
                    icon: '{$icon}',
                    tooltip: '{$tooltip}',
                    scope: this,
                    handler: {$handler}
                }";

            $items[] = $code;
        }
        $columnCode[] = "items: [
            ".implode(",\n\t\t\t\t\t\t", $items)."
        ]";

        return forward_static_call(['static', '_implode'], $columnCode);
    }

    /**
     * Implode column components to formated string
     *
     * @param array $components
     * @return string
     */
    public static function _implode(array $components)
    {
        return "\n\t\t\t\t{\n\t\t\t\t\t".implode(",\n\t\t\t\t\t", $components)."\n\t\t\t\t}";
    }
}