<?php

/*
 * This file is part of the Icybee package.
 *
 * (c) Olivier Laviale <olivier.laviale@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ICanBoogie;

chdir(__DIR__);

$module_dir = __DIR__ . '/../vendor/icanboogie-modules';

if (!file_exists($module_dir)) {
	mkdir($module_dir);
}

require __DIR__ . '/../vendor/autoload.php';

$app = boot();
$app->modules->install();
