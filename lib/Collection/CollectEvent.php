<?php

/*
 * This file is part of the Icybee package.
 *
 * (c) Olivier Laviale <olivier.laviale@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Icybee\Modules\Cache\Collection;

use ICanBoogie\Event;
use Icybee\Modules\Cache\Collection;

/**
 * Event class for the `Icybee\Modules\Cache\Collection::collect` event.
 */
class CollectEvent extends Event
{
	/**
	 * Reference to the cache manager collection.
	 *
	 * @var array
	 */
	public $collection;

	/**
	 * The event is constructed with the type `collect`.
	 *
	 * @param Collection $target
	 * @param array $collection Cache manager collection.
	 */
	public function __construct(Collection $target, array &$collection)
	{
		$this->collection = &$collection;

		parent::__construct($target, 'collect');
	}
}
