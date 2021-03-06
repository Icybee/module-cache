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

use function ICanBoogie\app;
use ICanBoogie\Storage\Storage;

class Module extends \Icybee\Module
{
	static public function get_files_stat($path, $pattern=null)
	{
		$app = app();

		if (!file_exists($path))
		{
			set_error_handler(function () {});
			mkdir($path, 0705, true);
			restore_error_handler();

			if (!file_exists($path))
			{
				return [

					0, '<span class="warning">' . $app->translate("Unable to create directory: %dir.", [ 'dir' => \ICanBoogie\strip_root($path) ]) . '</span>'

				];
			}
		}

		if (!is_writable($path))
		{
			return [

				0, '<span class="warning">' . $app->translate("The directory is not writable: %dir.", [ 'dir' => \ICanBoogie\strip_root($path) ]) . '</span>'

			];
		}

		$n = 0;
		$size = 0;
		$iterator = new \DirectoryIterator($path);

		if ($pattern)
		{
			$iterator = new \RegexIterator($iterator, $pattern);
		}

		foreach ($iterator as $file)
		{
			$filename = $file->getFilename();

			if ($filename{0} == '.')
			{
				continue;
			}

			++$n;
			$size += $file->getSize();
		}

		return [

			$n, $app->translate(':count files<br /><span class="small">:size</span>', [ ':count' => $n, 'size' => \ICanBoogie\I18n\format_size($size) ])

		];
	}

	static public function get_storage_stat(Storage $storage, $regex = null)
	{
		$n = 0;
		$size = 0;
		$app = app();

		$iterator = $storage;

		if ($regex)
		{
			$iterator = new \RegexIterator($iterator->getIterator(), $regex);
		}

		foreach ($iterator as $key)
		{
			$n++;
			$value = $storage->retrieve($key);

			if (!is_string($value))
			{
				$value = serialize($value);
			}

			$size += strlen($value);
		}

		return [

			$n, $app->translate(':count items<br /><span class="small">:size</span>', [

				':count' => $n,
				'size' => \ICanBoogie\I18n\format_size($size)

			])

		];
	}

	/**
	 * Deletes files in a directory according to a RegEx pattern.
	 *
	 * @param string $path Path to the directory where the files should be deleted.
	 * @param string|null $pattern RegEx pattern to delete matching files, or null to delete all
	 * files.
	 *
	 * @return int
	 */
	static public function clear_files($path, $pattern=null)
	{
		$root = \ICanBoogie\DOCUMENT_ROOT;

		if (strpos($path, $root) !== 0)
		{
			$path = $root . $path;
		}

		if (!is_dir($path))
		{
			return false;
		}

		$n = 0;
		$dh = opendir($path);

		while (($file = readdir($dh)) !== false)
		{
			if ($file{0} == '.' || ($pattern && !preg_match($pattern, $file)))
			{
				continue;
			}

			$n++;
			unlink($path . '/' . $file);
		}

		return $n;
	}
}
