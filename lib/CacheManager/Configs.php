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

use Icybee\Modules\Cache\CacheManagerBase;
use Icybee\Modules\Cache\Module;

/**
 * Configurations cache manager.
 */
class Configs extends CacheManagerBase
{
	public $title = "Configurations";
	public $description = "Configuration files of the framework components.";
	public $group = 'system';

	public function __construct()
	{
		$this->state = $this->app->config['cache configs'];
	}

	/**
	 * Clears the cache.
	 */
	public function clear()
	{
		$this->app->storage_for_configs->clear();
	}

	/**
	 * Disables the cache.
	 *
	 * Unsets the `enable_modules_cache` var.
	 */
	public function disable()
	{
		unset($this->app->vars['enable_configs_cache']);

		return true;
	}

	/**
	 * Enables the cache.
	 *
	 * Sets the `enable_modules_cache` var.
	 */
	public function enable()
	{
		$this->app->vars['enable_configs_cache'] = true;

		return true;
	}

	/**
	 * Return stats about the cache.
	 */
	public function stat()
	{
		return Module::get_storage_stat($this->app->storage_for_configs);
	}
}
