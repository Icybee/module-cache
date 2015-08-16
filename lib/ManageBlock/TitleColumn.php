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

use ICanBoogie\I18n;

use Brickrouge\ListView;
use Brickrouge\ListViewColumn;

use Icybee\Modules\Cache\CacheManager;

class TitleColumn extends ListViewColumn
{
	public function __construct(ListView $listview, $id, array $options = [])
	{
		parent::__construct($listview, $id, $options + [

			'title' => 'Cache type'

		]);
	}

	/**
	 * @param CacheManager $cache
	 *
	 * @inheritdoc
	 */
	public function render_cell($cache)
	{
		$title = $this->t($cache->title, [], [ 'scope' => 'cache.title' ]);
		$description = $this->t($cache->description, [], [ 'scope' => 'cache.description' ]);

		return <<<EOT
$title<div class="element-description">$description</div>
EOT;
	}
}
