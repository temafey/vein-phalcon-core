<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Grid\DataTable;

use Vein\Core\Crud\Grid\DataTable as Grid,
    Vein\Core\Crud\Grid\Column,
    Vein\Core\Crud\Form\Field,
    Vein\Core\Crud\Helper\Form\DataTable\BaseHelper as FieldHelper;

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
	 * @param \Vein\Core\Crud\Grid\DataTable $grid
	 * @return string
	 */
	static public function _(Grid $grid)
	{
        $code = '
            columns: [';

        $columns = [];
        foreach ($grid->getColumns() as $column) {
            if ($column instanceof Column) {
                $type = $column->getType();
                /*if (!method_exists(__CLASS__, '_'.$type)) {
                    throw new \Vein\Core\Exception('Field with type ''.$type.'' haven't render method in ''.__CLASS__.''');
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

        $code .= implode(',', $columns);

        $code .= '
            ],';
        
        return $code;
	}

    /**
     * Render grid colum
     *
     * @param \Vein\Core\Crud\Grid\Column $column
     *
     * @return string
     */
    public static function _column(Column $column)
    {
        $columnCode = [];
        $columnCode[] = 'data: '.$column->getKey();

        $columnCode[] = $column->isSortable() ? 'orderable: true' : 'orderable: false';

        if ($column->isHidden()) {
            $columnCode[] = 'hidden: true';
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
        $columnCode[] = '{';
        $columnCode[] = 'data: '.$column->getKey();

        $columnCode[] = $column->isSortable() ? 'orderable: true' : 'orderable: false';

        if ($column->isHidden()) {
            $columnCode[] = 'hidden: true';
        }
        $columnCode[] = '}';

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
        $columnCode[] = '{';
        $columnCode[] = 'data: '.$column->getKey();

        $columnCode[] = $column->isSortable() ? 'orderable: true' : 'orderable: false';

        if ($column->isHidden()) {
            $columnCode[] = 'hidden: true';
        }
        $columnCode[] = '}';

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
        $columnCode[] = '{';
        $columnCode[] = 'data: '.$column->getKey();

        $columnCode[] = $column->isSortable() ? 'orderable: true' : 'orderable: false';

        if ($column->isHidden()) {
            $columnCode[] = 'hidden: true';
        }
        $columnCode[] = '}';

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
        $columnCode[] = '{';
        $columnCode[] = 'data: '.$column->getKey();

        $columnCode[] = $column->isSortable() ? 'orderable: true' : 'orderable: false';

        if ($column->isHidden()) {
            $columnCode[] = 'hidden: true';
        }
        $columnCode[] = '}';

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
        $columnCode[] = '{';
        $columnCode[] = 'data: '.$column->getKey();

        $columnCode[] = $column->isSortable() ? 'orderable: true' : 'orderable: false';

        if ($column->isHidden()) {
            $columnCode[] = 'hidden: true';
        }
        $columnCode[] = '}';

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
        $columnCode[] = '{';
        $columnCode[] = 'data: '.$column->getKey();

        $columnCode[] = $column->isSortable() ? 'orderable: true' : 'orderable: false';

        if ($column->isHidden()) {
            $columnCode[] = 'hidden: true';
        }
        $columnCode[] = '}';

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

        $items = [];
        foreach ($column->getItems() as $item) {
            $icon = $item['icon'];
            if (isset($item['name'])) {
                $tooltip = $item['name'];
            } elseif ($item['title']) {
                $tooltip = $item['title'];
            }
            if (isset($item['content'])) {
                $content = $item['content'];
                if (strtolower($content) === 'delete') {
                    $content = '<a href="#" class="remove">Delete</a>';
                    $function = '';
                } elseif (strtolower($content) === 'edit') {
                    $content = '<a href="#" class="edit">Edit</a>';
                }
            }
            if (isset($item['function'])) {
                $function = $item['function'];
            }
            $code = '{
                data: null,
                defaultContent: \''.$content.'\',
                orderable: false
            ';

            $items[] = $code;
        }

        $columnCode = '
            '.implode(",\n\t\t\t\t\t\t", $items).'
        ';

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