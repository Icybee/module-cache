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

use ICanBoogie\GetterTrait;

/**
 * Cache.
 *
 * @property-read \ICanBoogie\Core $app
 */
abstract class CacheManager implements CacheManagerInterface
{
	use GetterTrait;

	/**
	 * Title of the cache. The title is translated within the `cache.title` scope.
	 *
	 * @var string
	 */
	public $title;

	/**
	 * Description of the cache. The description is translated within
	 * the `cache.description` scope.
	 *
	 * @var string
	 */
	public $description;

	/**
	 * Caches are displayed by groups. The group of the cache can be defined using this property.
	 * The group is translated within the `cache.group` scope.
	 *
	 * @var string
	 */
	public $group;

	/**
	 * Whether the cache is enabled.
	 *
	 * @var bool
	 */
	public $state = false;

	/**
	 * Size limit of the cache, or `false` if not applicable.
	 *
	 * @var int|bool
	 */
	public $size_limit = false;

	/**
	 * Time limit of the entries in the cache, or `false` if not applicable.
	 *
	 * @var int|bool
	 */
	public $time_limit = false;

	/**
	 * A preview of the cache configuration, or `null` if not applicable.
	 *
	 * @var string|null
	 */
	public $config_preview;

	/**
	 * The configuration editor, or `null` if not applicable.
	 *
	 * @var string|null
	 */
	public $editor;

	protected function get_app()
	{
		return \ICanBoogie\app();
	}
}
