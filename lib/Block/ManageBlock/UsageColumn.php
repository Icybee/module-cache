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

class UsageColumn extends ListViewColumn
{
	public function __construct(ListView $listview, $id, array $options = [])
	{
		parent::__construct($listview, $id, $options + [

			'title' => 'Usage'

		]);
	}

	/**
	 * @param CacheManager $cache
	 *
	 * @inheritdoc
	 */
	public function render_cell($cache)
	{
		list($n, $stat) = $cache->stat();

		return $stat;
	}
}
