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

use ICanBoogie\AppConfig;

$vars_path = 'repository/var' . DIRECTORY_SEPARATOR;

return [

	AppConfig::CACHE_CATALOGS => file_exists($vars_path . 'enable_catalogs_cache'),
	AppConfig::CACHE_CONFIGS => file_exists($vars_path . 'enable_configs_cache'),
	AppConfig::CACHE_MODULES => file_exists($vars_path . 'enable_modules_cache')

];
