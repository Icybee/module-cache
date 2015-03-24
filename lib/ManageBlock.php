<?php

/*
 * This file is part of the Icybee package.
 *
 * (c) Olivier Laviale <olivier.laviale@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Icybee\Modules\Cache;

use Brickrouge\Document;
use Brickrouge\ListView;

use Icybee\Modules\Cache\ManageBlock\ClearColumn;
use Icybee\Modules\Cache\ManageBlock\ConfigurationColumn;
use Icybee\Modules\Cache\ManageBlock\IsActiveColumn;
use Icybee\Modules\Cache\ManageBlock\TitleColumn;
use Icybee\Modules\Cache\ManageBlock\UsageColumn;

class ManageBlock extends ListView
{
	static public function add_assets(Document $document)
	{
		parent::add_assets($document);

		$document->css->add(\Icybee\ASSETS . 'css/manage.css');
		$document->css->add(DIR . 'public/admin.css');
		$document->js->add(DIR . 'public/admin.js');
	}

	protected $module;

	/**
	 * Cache collection.
	 *
	 * @var Collection
	 */
	protected $collection;

	public function __construct(Module $module, array $attributes = [])
	{
		$this->module = $module;
		$this->collection = Collection::get();

		parent::__construct($attributes + [

			self::COLUMNS => [

				'is_active' => IsActiveColumn::class,
				'title' => TitleColumn::class,
				'configuration' => ConfigurationColumn::class,
				'usage' => UsageColumn::class,
				'clear' => ClearColumn::class

			],

			self::ENTRIES => $this->collection

		]);
	}

	protected function get_entries()
	{
		$indexed_entries = [];
		$i = 0;

		foreach (parent::get_entries() as $entry)
		{
			$indexed_entries[$i++] = $entry;
		}

		return $indexed_entries;
	}

	protected function render_rows(array $rows)
	{
		$rendered_rows = parent::render_rows($rows);
		$entries = $this->entries;
		$grouped = [];

		foreach ($rendered_rows as $i => $row)
		{
			$cache = $entries[$i];
			$group_title = $this->t(ucfirst($cache->group), [], [ 'scope' => 'cache.group' ]);
			$grouped[$group_title][$i] = $row;
		}

		$rendered_rows = [];

		foreach ($grouped as $group_title => $rows)
		{
			$rendered_rows[] = <<<EOT
<tr class="listview-divider">
	<td>&nbsp;</td>
	<td>$group_title</td>
	<td colspan="3">&nbsp;</td>
</tr>
EOT;
			foreach ($rows as $i => $row)
			{
				$cache = $entries[$i];

				try
				{
					list($n, $stat) = $cache->stat();
				}
				catch (\Exception $e)
				{
					$n = null;
				}

				if (!$n)
				{
					$row->add_class('empty');
				}

				$row['data-entry-key'] = $cache->id;

				$rendered_rows[] = $row;
			}
		}

		return $rendered_rows;
	}
}
