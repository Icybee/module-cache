<?php

/*
 * This file is part of the Icybee package.
 *
 * (c) Olivier Laviale <olivier.laviale@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Icybee\Modules\Cache\Routing;

use Brickrouge\Popover;

use Icybee\Binding\Core\PrototypedBindings;
use Icybee\Modules\Cache\Binding\CoreBindings;
use Icybee\Modules\Cache\Module;
use Icybee\Routing\AdminController;

/**
 * @property-read \ICanBoogie\Core|CoreBindings $app
 */
class CacheAdminController extends AdminController
{
	use PrototypedBindings;

	protected function action_get_editor($cache_id)
	{
		$this->assert_has_permission(Module::PERMISSION_ACCESS, $this->module);

		$cache = $this->app->caches[$cache_id];

		return new Popover([

			Popover::INNER_HTML => (string) $cache->editor,
			Popover::ACTIONS => 'boolean',
			Popover::FIT_CONTENT => true,

			'class' => 'popover contrast'

		]);
	}
}
