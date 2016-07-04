<?php
/**
 * @namespace
 */
namespace Vein\Core\Crud\Helper\Filter\Standart;

use Vein\Core\Crud\Grid\Filter,
	Vein\Core\Crud\Grid\Filter\Field;

/**
 * Class grid datastore helper
 *
 * @category   Vein\Core
 * @package    Crud
 * @subpackage Helper
 */
class Body extends BaseHelper
{
	/**
	 * Generates grid table rows
	 *
	 * @param \Vein\Core\Crud\Grid\Filter  $filter
     *
     * @return string
	 */
	static public function _(Filter $filter)
	{
		$code = '	
			<div class="box-body pad">	
				<div class="box-body">';

		$fields = [];
		foreach ($filter->getFields() as $field) {
			if ($field instanceof Field\Submit) {
				continue;
			}

			if ($field instanceof Field) {
				$fields[] = self::renderField($field);
			}
		}
		$code .= implode("\n", $fields);

		$code .= '
				</div>
            </div>';

        return $code;
	}
}