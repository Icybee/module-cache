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
use ICanBoogie\Storage\Storage;
use Icybee\Modules\Cache\CacheManagerBase;
use Icybee\Modules\Cache\Module;

/**
 * Modules cache manager.
 */
class Modules extends CacheManagerBase
{
	const VAR_ENABLE = 'enable_modules_cache';
	const REGEX = '/^cached_modules_/';

	public $title = "Modules";
	public $description = "Modules index.";
	public $group = 'system';

	/**
	 * @var Storage
	 */
	private $storage;

	public function __construct()
	{
		$this->state = $this->app->config[AppConfig::CACHE_MODULES];
		$this->storage = $this->app->vars;
	}

	/**
	 * Clears the cache.
	 */
	public function clear()
	{
		$storage = $this->storage;
		$iterator = $storage->getIterator();
		$iterator = new \RegexIterator($iterator, self::REGEX);

		foreach ($iterator as $key)
		{
			$storage->eliminate($key);
		}

		return true;
	}

	/**
	 * Disables the cache.
	 *
	 * Unsets the `enable_modules_cache` var.
	 */
	public function disable()
	{
		unset($this->storage[self::VAR_ENABLE]);

		return true;
	}

	/**
	 * Enables the cache.
	 *
	 * Sets the `enable_modules_cache` var.
	 */
	public function enable()
	{
		$this->storage[self::VAR_ENABLE] = true;

		return true;
	}

	/**
	 * Return stats about the cache.
	 */
	public function stat()
	{
		return Module::get_storage_stat($this->storage, self::REGEX);
	}
}
