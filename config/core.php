<?php

namespace Icybee\Modules\Cache;

$vars_path = \ICanBoogie\REPOSITORY . 'vars' . DIRECTORY_SEPARATOR;

return [

	'cache catalogs' => file_exists($vars_path . 'enable_catalogs_cache'),
	'cache configs' => file_exists($vars_path . 'enable_configs_cache'),
	'cache modules' => file_exists($vars_path . 'enable_modules_cache')

];
