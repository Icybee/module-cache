<?php

namespace Icybee\Modules\Cache;

use function ICanBoogie\app;

class ApplicationTest extends \PHPUnit_Framework_TestCase
{
	public function testGetCaches()
	{
		$caches = app()->caches;

		$this->assertInstanceOf(CacheCollection::class, $caches);
	}
}
