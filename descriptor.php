<?php

namespace Icybee\Modules\Cache;

use ICanBoogie\Module\Descriptor;

return array
(
	Descriptor::CATEGORY => 'features',
	Descriptor::DESCRIPTION => "Provides a unified cache system",
	Descriptor::NS => __NAMESPACE__,
	Descriptor::PERMISSIONS => array
	(
		'administer system cache'
	),

	Descriptor::REQUIRED => true,
	Descriptor::TITLE => 'Cache',
	Descriptor::VERSION => '1.0'
);