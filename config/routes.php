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

use ICanBoogie\HTTP\Request;
use ICanBoogie\Operation;

use Icybee\Modules\Cache\Operation\ClearOperation;
use Icybee\Modules\Cache\Operation\DisableOperation;
use Icybee\Modules\Cache\Operation\EnableOperation;
use Icybee\Routing\RouteMaker as Make;

return [

	'api:cache:enable' => [

		'pattern' => '/api/cache/:cache_id/enabled',
		'controller' => EnableOperation::class,
		'via' => Request::METHOD_PUT,
		'param_translation_list' => [

			'cache_id' => Operation::KEY

		]

	],

	'api:cache:disable' => [

		'pattern' => '/api/cache/:cache_id/enabled',
		'controller' => DisableOperation::class,
		'via' => Request::METHOD_DELETE,
		'param_translation_list' => [

			'cache_id' => Operation::KEY

		]

	],

	'api:cache:clear' => [

		'pattern' => '/api/cache/:cache_id',
		'controller' => ClearOperation::class,
		'via' => Request::METHOD_DELETE,
		'param_translation_list' => [

			'cache_id' => Operation::KEY

		]

	],

	'api:cache:editor' => [

		'pattern' => '/api/cache/:cache_id/editor',
		'controller' => Routing\CacheAdminController::class . '#editor',
		'via' => Request::METHOD_GET

	]

] + Make::admin('cache', Routing\CacheAdminController::class, [

	'only' => 'index'

]);
