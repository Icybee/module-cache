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

use ICanBoogie\OffsetNotWritable;

/**
 * Cache manager collection.
 */
class CacheCollection implements \IteratorAggregate, \ArrayAccess
{
	static private $instance;

	static public function get()
	{
		if (self::$instance)
		{
			return self::$instance;
		}

		return self::$instance = new static();
	}

	protected $collection = [];

	protected function __construct()
	{
		$collection = [

			'core.catalogs' => new CacheManager\Catalogs,
			'core.configs' => new CacheManager\Configs,
			'core.modules' => new CacheManager\Modules

		];

		new CacheCollection\CollectEvent($this, $collection);

		foreach ($collection as $id => $cache)
		{
			$cache->id = $id;
		}

		$this->collection = $collection;
	}

	function getIterator()
	{
		return new \ArrayIterator($this->collection);
	}

	public function offsetExists($offset)
	{
		return isset($this->collection[$offset]);
	}

	/**
	 * Returns a cache.
	 *
	 * @inheritdoc
	 *
	 * @throws CacheNotDefined in attempt to get a cache manager that is not defined.
	 */
	public function offsetGet($id)
	{
		if (!$this->offsetExists($id))
		{
			throw new CacheNotDefined($id);
		}

		return $this->collection[$id];
	}

	/**
	 * Adds a cache to the collection.
	 *
	 * @inheritdoc
	 *
	 * @throws \InvalidArgumentException if the cache manage doesn't implement {@link CacheManagerInterface}.
	 */
	public function offsetSet($id, $cache)
	{
		if (!($cache instanceof CacheManagerInterface))
		{
			throw new \InvalidArgumentException('Cache must implements ' . CacheManagerInterface::class . '.');
		}

		$this->collection[$id] = $cache;
	}

	/**
	 * @inheritdoc
	 *
	 * @throws OffsetNotWritable in attempt to unset an offset.
	 */
	public function offsetUnset($offset)
	{
		throw new OffsetNotWritable([ $offset, $this ]);
	}
}
