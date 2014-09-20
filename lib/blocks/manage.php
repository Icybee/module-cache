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

use ICanBoogie\I18n;

class ManageBlock extends \Brickrouge\ListView
{
	static public function add_assets(\Brickrouge\Document $document)
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

	public function __construct(Module $module, array $attributes=array())
	{
		$this->module = $module;
		$this->collection = Collection::get();

		parent::__construct
		(
			$attributes + array
			(
				self::COLUMNS => array
				(
					'is_active' => __CLASS__ . '\IsActiveColumn',
					'title' => __CLASS__ . '\TitleColumn',
					'configuration' => __CLASS__ . '\ConfigurationColumn',
					'usage' => __CLASS__ . '\UsageColumn',
					'clear' => __CLASS__ . '\ClearColumn'
				),

				self::ENTRIES => $this->collection
			)
		);
	}

	protected function get_entries()
	{
		$indexed_entries = array();
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
		$grouped = array();

		foreach ($rendered_rows as $i => $row)
		{
			$cache = $entries[$i];
			$group_title = I18n\t(ucfirst($cache->group), array(), array('scope' => 'cache.group'));
			$grouped[$group_title][$i] = $row;
		}

		$rendered_rows = array();

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

				list($n, $stat) = $cache->stat();

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

namespace Icybee\Modules\Cache\ManageBlock;

use ICanBoogie\I18n;

use Brickrouge\Button;
use Brickrouge\Element;
use Brickrouge\ListView;
use Brickrouge\ListViewColumn;
use Icybee\WrappedCheckbox;

class IsActiveColumn extends ListViewColumn
{
	public function __construct(ListView $listview, $id, array $options=array())
	{
		parent::__construct
		(
			$listview, $id, $options + array
			(
				'title' => null
			)
		);
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

class TitleColumn extends ListViewColumn
{
	public function __construct(ListView $listview, $id, array $options=array())
	{
		parent::__construct
		(
			$listview, $id, $options + array
			(
				'title' => 'Cache type'
			)
		);
	}

	public function render_cell($cache)
	{
		$title = I18n\t($cache->title, array(), array('scope' => 'cache.title'));
		$description = I18n\t($cache->description, array(), array('scope' => 'cache.description'));

		return <<<EOT
$title<div class="element-description">$description</div>
EOT;
	}
}

class ConfigurationColumn extends ListViewColumn
{
	public function __construct(ListView $listview, $id, array $options=array())
	{
		parent::__construct
		(
			$listview, $id, $options + array
			(
				'title' => 'Configuration'
			)
		);
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

class UsageColumn extends ListViewColumn
{
	public function __construct(ListView $listview, $id, array $options=array())
	{
		parent::__construct
		(
			$listview, $id, $options + array
			(
				'title' => 'Usage'
			)
		);
	}

	public function render_cell($cache)
	{
		list($n, $stat) = $cache->stat();

		return $stat;
	}
}

class ClearColumn extends ListViewColumn
{
	public function __construct(ListView $listview, $id, array $options=array())
	{
		parent::__construct
		(
			$listview, $id, $options + array
			(
				'title' => null
			)
		);
	}

	public function render_cell($cache)
	{
		return new Button('Clear', array('class' => 'btn-warning', 'name' => 'clear'));
	}
}