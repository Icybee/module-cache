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
 * Modules cache manager.
 */
class Modules extends CacheManagerBase
{
	const REGEX = '/^cached_modules_/';

	public $title = "Modules";
	public $description = "Modules index.";
	public $group = 'system';

	public function __construct()
	{
		$this->state = $this->app->config['cache modules'];
	}

	/**
	 * Clears the cache.
	 */
	public function clear()
	{
		$iterator = $this->app->vars->matching(self::REGEX);
		$iterator->delete();

		return true;
	}

	/**
	 * Disables the cache.
	 *
	 * Unsets the `enable_modules_cache` var.
	 */
	public function disable()
	{
		unset($this->app->vars['enable_modules_cache']);

		return true;
	}

	/**
	 * Enables the cache.
	 *
	 * Sets the `enable_modules_cache` var.
	 */
	public function enable()
	{
		$this->app->vars['enable_modules_cache'] = true;

		return true;
	}

	/**
	 * Return stats about the cache.
	 */
	public function stat()
	{
		return Module::get_vars_stat(self::REGEX);
	}
}
