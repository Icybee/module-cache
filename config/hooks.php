<?php

namespace Icybee\Modules\Cache;

$hooks = __NAMESPACE__ . '\Hooks::';

return [

	'events' => [

		'Icybee\Modules\Modules\ActivateOperation::process' => $hooks . 'on_modules_change',
		'Icybee\Modules\Modules\DeactivateOperation::process' => $hooks . 'on_modules_change'

	],

	'prototypes' => [

		'ICanBoogie\Core::get_caches' => __NAMESPACE__ . '\Collection::get'

	]

];
