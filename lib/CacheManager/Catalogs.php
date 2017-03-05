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

use ICanBoogie\AppConfig;
use Icybee\Modules\Cache\CacheManagerBase;
use Icybee\Modules\Cache\Module;

/**
 * Catalogs cache manager.
 */
class Catalogs extends CacheManagerBase
{
	const VAR_ENABLE = 'enable_catalogs_cache';

	public $title = "Translations";
	public $description = "Translation catalogs for the I18n component.";
	public $group = 'system';

	/**
	 * @var string
	 */
	private $directory;

	public function __construct()
	{
		$config = $this->app->config;
		$this->state = $config[AppConfig::CACHE_CATALOGS];
		$this->directory = $config[AppConfig::REPOSITORY_CACHE] . '/core';
	}

	/**
	 * Clears the cache.
	 */
	public function clear()
	{
		$files = glob("$this->directory/i18n_*");

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
		unset($this->app->vars['enable_catalogs_cache']);

		return true;
	}

	/**
	 * Enables the cache.
	 *
	 * Sets the `enable_catalogs_cache` var.
	 */
	public function enable()
	{
		$this->app->vars['enable_catalogs_cache'] = true;

		return true;
	}

	/**
	 * Return stats about the cache.
	 */
	public function stat()
	{
		return Module::get_files_stat($this->directory, '#^i18n_#');
	}
}
