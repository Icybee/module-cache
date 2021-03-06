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

use Icybee;

$hooks = Hooks::class . '::';

return [

	Icybee\Modules\Modules\Operation\ActivateOperation::class . '::process' => $hooks . 'on_modules_change',
	Icybee\Modules\Modules\Operation\DeactivateOperation::class . '::process' => $hooks . 'on_modules_change'

];
