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

use ICanBoogie;
use Icybee;

return [

	ICanBoogie\Core::class . '::get_caches' => CacheCollection::class . '::get'

];
