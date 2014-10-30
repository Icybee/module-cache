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

/**
 * Configures the specified cache.
 */
class ConfigOperation extends BaseOperation
{
	protected function process()
	{
		$cache = $this->collection[$this->key];

		$cache->config($this->request);

		$this->response->message = $this->format('The cache %cache has been configured.', [

			'cache' => $this->key

		]);

		return $cache->config_preview;
	}
}
