<?php

/*
 * This file is part of the Icybee package.
 *
 * (c) Olivier Laviale <olivier.laviale@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Icybee\Modules\Cache\CacheManager;

use Icybee\Modules\Cache\CacheManager;
use Icybee\Modules\Cache\Module;

/**
 * Catalogs cache manager.
 */
class Catalogs extends CacheManager
{
	public $title = "Translations";
	public $description = "Translation catalogs for the I18n component.";
	public $group = 'system';

	public function __construct()
	{
		global $core;

		$this->state = $core->config['cache catalogs'];
	}

	/**
	 * Clears the cache.
	 */
	public function clear()
	{
		global $core;

		$files = glob(\ICanBoogie\REPOSITORY . 'cache/core/i18n_*');

		foreach ($files as $file)
		{
			unlink($file);
		}

		return count($files);
	}

	/**
	 * Disables the cache.
	 *
	 * Unsets the `enable_catalogs_cache` var.
	 */
	public function disable()
	{
		global $core;

		unset($core->vars['enable_catalogs_cache']);

		return true;
	}

	/**
	 * Enables the cache.
	 *
	 * Sets the `enable_catalogs_cache` var.
	 */
	public function enable()
	{
		global $core;

		$core->vars['enable_catalogs_cache'] = true;

		return true;
	}

	/**
	 * Return stats about the cache.
	 */
	public function stat()
	{
		return Module::get_files_stat(\ICanBoogie\REPOSITORY . 'cache/core', '#^i18n_#');
	}
}