<?php

namespace Icybee\Modules\Cache;

use ICanBoogie\Module\Descriptor;

return [

	Descriptor::CATEGORY => 'features',
	Descriptor::DESCRIPTION => "Provides a unified cache system",
	Descriptor::NS => __NAMESPACE__,
	Descriptor::PERMISSIONS => [

		'administer system cache'

	],

	Descriptor::TITLE => "Cache"

];
