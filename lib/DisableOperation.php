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

use ICanBoogie\I18n\FormattedString;

/**
 * Disables the specified cache.
 */
class DisableOperation extends BaseOperation
{
	protected function process()
	{
		$cache = $this->collection[$this->key];

		$this->response->message = new FormattedString('The cache %cache has been disabled.', [ 'cache' => $this->key ]);

		return $cache->disable();
	}
}