<?php

/*
 * This file is part of the Icybee package.
 *
 * (c) Olivier Laviale <olivier.laviale@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Icybee\Modules\Cache\Operation;

use ICanBoogie\ErrorCollection;
use ICanBoogie\Module;
use ICanBoogie\Operation;

use Icybee\Modules\Cache\CacheCollection;

/**
 * @property-read CacheCollection $collection Caches collection.
 */
abstract class BaseOperation extends Operation
{
	protected function get_controls()
	{
		return [

			self::CONTROL_PERMISSION => Module::PERMISSION_ADMINISTER

		] + parent::get_controls();
	}

	protected function get_collection()
	{
		return CacheCollection::get();
	}

	protected function validate(ErrorCollection $errors)
	{
		return $errors;
	}
}
