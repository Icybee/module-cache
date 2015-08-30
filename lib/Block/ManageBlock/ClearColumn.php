<?php

/*
 * This file is part of the Icybee package.
 *
 * (c) Olivier Laviale <olivier.laviale@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Icybee\Modules\Cache\Block\ManageBlock;

use Brickrouge\Button;
use Brickrouge\ListView;
use Brickrouge\ListViewColumn;

class ClearColumn extends ListViewColumn
{
	public function __construct(ListView $listview, $id, array $options = [])
	{
		parent::__construct($listview, $id, $options + [

			'title' => null

		]);
	}

	public function render_cell($cache)
	{
		return new Button('Clear', [ 'class' => 'btn-warning', 'name' => 'clear' ]);
	}
}
