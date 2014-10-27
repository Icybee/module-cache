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

class ConfigurationColumn extends ListViewColumn
{
	public function __construct(ListView $listview, $id, array $options=[])
	{
		parent::__construct($listview, $id, $options + [

			'title' => 'Configuration'

		]);
	}

	public function render_cell($cache)
	{
		$config_preview = $cache->config_preview;

		if (!$config_preview)
		{
			return;
		}

		return '<span title="Configure the cache" class="spinner" tabindex="0">' . $config_preview . '</span>';
	}
}
