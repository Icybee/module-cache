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

use Brickrouge\ListView;
use Brickrouge\ListViewColumn;

use Icybee\Modules\Cache\CacheManager;
use Icybee\Element\WrappedCheckbox;

class IsActiveColumn extends ListViewColumn
{
	public function __construct(ListView $listview, $id, array $options = [])
	{
		parent::__construct($listview, $id, $options + [

			'title' => null


		]);
	}

	/**
	 * @param CacheManager $cache
	 *
	 * @inheritdoc
	 */
	public function render_cell($cache)
	{
		$checked = $cache->state;

		return new WrappedCheckbox([

			'checked' => $checked,
			'disabled' => $cache->state === null,
			'name' => $cache->id,
			'title' => "Enable/disable the cache",
			'class' => 'wrapped-checkbox circle'

		]);
	}
}
