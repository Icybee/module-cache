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

use Icybee\Routing\RouteMaker as Make;

return Make::admin('cache', Routing\CacheAdminController::class, [

	'only' => 'index'

]);
