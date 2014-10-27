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
 * Configurations cache manager.
 */
class Configs extends CacheManager
{
	public $title = "Configurations";
	public $description = "Configuration files of the framework components.";
	public $group = 'system';

	public function __construct()
	{
		global $core;

		$this->state = $core->config['cache configs'];
	}

	/**
	 * Clears the cache.
	 */
	public function clear()
	{
		$path = $this->get_path();

		if (!file_exists($path))
		{
			return 0;
		}

		$di = new \DirectoryIterator($path);
		$n = 0;

		foreach ($di as $file)
		{
			if (!$file->isFile())
			{
				continue;
			}

			$n++;

			unlink($file->getPathname());
		}

		return $n;
	}

	/**
	 * Disables the cache.
	 *
	 * Unsets the `enable_modules_cache` var.
	 */
	public function disable()
	{
		global $core;

		unset($core->vars['enable_configs_cache']);

		return true;
	}

	/**
	 * Enables the cache.
	 *
	 * Sets the `enable_modules_cache` var.
	 */
	public function enable()
	{
		global $core;

		$core->vars['enable_configs_cache'] = true;

		return true;
	}

	/**
	 * Return stats about the cache.
	 */
	public function stat()
	{
		return Module::get_files_stat($this->get_path());
	}

	private function get_path()
	{
		return \ICanBoogie\REPOSITORY . 'cache' . DIRECTORY_SEPARATOR . 'configs';
	}
}
