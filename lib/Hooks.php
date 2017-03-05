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

use function ICanBoogie\app;
use ICanBoogie\HTTP\Request;
use ICanBoogie\Operation;

class Hooks
{
	/**
	 * Clears the `core.modules`, `core.configs` and `core.catalogs` caches.
	 */
	static public function clear_modules_cache()
	{
		$app = app();
		$caches = [ 'core.modules', 'core.configs', 'core.catalogs' ];
		$route = $app->routes['api:cache:clear'];

		foreach ($caches as $cache_id)
		{
			$request = Request::from([

				'uri' => $route->format([ 'cache_id' => $cache_id ]),
				'method' => $route->via

			]);

			$request();
		}
	}

	/**
	 * Clears ICanBoogie caches on modules change.
	 *
	 * @param Operation\ProcessEvent $event
	 */
	static public function on_modules_change(Operation\ProcessEvent $event)
	{
		self::clear_modules_cache();
	}
}
