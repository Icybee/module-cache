<?php

/*
 * This file is part of the Icybee package.
 *
 * (c) Olivier Laviale <olivier.laviale@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Icybee\Modules\Cache\ManageBlock;

use Brickrouge\ListView;
use Brickrouge\ListViewColumn;

use Icybee\WrappedCheckbox;

class IsActiveColumn extends ListViewColumn
{
	public function __construct(ListView $listview, $id, array $options=[])
	{
		parent::__construct($listview, $id, $options + [

			'title' => null


		]);
	}

	public function render_cell($entry)
	{
		$checked = $entry->state;

		return new WrappedCheckbox([

			'checked' => $checked,
			'disabled' => $entry->state === null,
			'name' => $entry->id,
			'title' => "Enable/disable the cache",
			'class' => 'wrapped-checkbox circle'

		]);
	}
}
