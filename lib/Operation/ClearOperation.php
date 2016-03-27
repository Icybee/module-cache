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

use ICanBoogie\ErrorCollection;

/**
 * Clears the specified cache.
 */
class ClearOperation extends BaseOperation
{
	protected function validate(ErrorCollection $errors)
	{
		if (!$this->key)
		{
			$errors->add('cache_id', "The cache identifier is required.");
		}

		return $errors;
	}

	protected function process()
	{
		$cache = $this->collection[$this->key];
		$cache->clear();

		$this->response->message = $this->format('The cache %cache has been cleared.', [

			'cache' => $this->key

		]);

		return $cache->stat();
	}
}
