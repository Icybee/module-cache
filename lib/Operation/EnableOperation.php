<?php

/*
 * This file is part of the Icybee package.
 *
 * (c) Olivier Laviale <olivier.laviale@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Icybee\Modules\Cache\Operation;

/**
 * Enables the specified cache.
 *
 * The cache is cleared before it is enabled.
 */
class EnableOperation extends BaseOperation
{
	protected function process()
	{
		$cache = $this->collection[$this->key];
		$cache->clear();

		$this->response->message = $this->format('The cache %cache has been enabled.', [

			'cache' => $this->key

		]);

		return $cache->enable();
	}
}
