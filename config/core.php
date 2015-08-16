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

$vars_path = \ICanBoogie\REPOSITORY . 'vars' . DIRECTORY_SEPARATOR;

return [

	'cache catalogs' => file_exists($vars_path . 'enable_catalogs_cache'),
	'cache configs' => file_exists($vars_path . 'enable_configs_cache'),
	'cache modules' => file_exists($vars_path . 'enable_modules_cache')

];
