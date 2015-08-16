# Cache

The Cache module (`cache`) provides a common API and a centralized place to manage caches.

The module comes with cache managers for the framework [ICanBoogie](http://icanboogie.org/).





## Cache managers





### Creating your own cache manager

You can use any kind of cache with the "cache" module, your manager only has to extends the
`CacheManagerBase` class or implement the `CacheManager` interface.

The following properties must also be provided:

- (string) `title`: Title of the cache. The title is translated within the `cache.title` scope.
- (string) `description`: Description of the cache. The description is translated within
the `cache.description` scope.
- (string) `group`: Caches are displayed by groups. The group of the cache can be defined using
this property. The group is translated within the `cache.group` scope.
- (bool) `state`: Whether the cache is enabled.
- (int|bool) `size_limit`: Size limit of the cache, or `false` if not applicable.
- (int|bool) `time_limit`: Time limit of the entries in the cache, or `false` if not applicable.
- (string|null) `config_preview`: A preview of the cache configuration, or `null` if not applicable.
- (string) `editor`: The configuration editor, or `null` if not applicable.

Note: Because the `config_preview` and `editor` properties are seldom used, it is advised to use
getters to return their values:

```php
<?php

use ICanBoogie\Accessor\AccessorTrait;
use ICanBoogie\PropertyNotDefined;

class CacheManagerBase implements Icybee\Modules\Cache\CacheManager
{
	use AccessorTrait;

	protected function get_config_preview()
	{
		return // …
	}

	protected function get_editor()
	{
		return // …
	}
}
```





### Registering your cache manager

Cache managers are registered on the `Icybee\Modules\Cache\CacheCollection::collect` event. For
instance, this is how the "views" module registers its cache manager using the `hooks`
configuration:

```php
<?php

// hooks.php

namespace Icybee\Modules\Views;

$hooks = __NAMESPACE__ . '\Hooks::';

return array
(
	'events' => array
	(
		'Icybee\Modules\Cache\CacheCollection::collect' => $hooks . 'on_cache_collection_collect',

		// ...
	),

	// ...
);
```




## Events





### Icybee\Modules\Cache\CacheCollection::collect

Third parties may use the event of class `Icybee\Modules\Cache\CacheCollection\CollectEvent` to
register their cache manager. The event is fired during the construct of the cache collection.

The following code is an example of how the `icybee.views` cache is added to the cache collection:

```php
<?php

namespace Icybee\Modules\Views;

use Icybee\Modules\Cache\CacheCollection as CacheCollection;

class Hooks
{
	// …

	static public function on_cache_collection_collect(CacheCollection\CollectEvent $event, CacheCollection $collection)
	{
		$event->collection['icybee.views'] = new ViewCacheManager;
	}

	// …
}
```





## Prototype methods





### `ICanBoogie\Core\get_caches`

The `get_caches` getter is added to instances of the `ICanBoogie\Core` class, it returns
the cache collection.

```php
<?php

$app->caches['core.modules']->clear();
```





## Operations

Cache operations require the cache identifier to be defined as key of the operation. For instance,
to clear the `core.modules` cache the operation `POST /api/cache/core.modules/clear` is used.





### Icybee\Modules\Cache\ClearOperation

Clears the specified cache.





### Icybee\Modules\Cache\ConfigureOperation

Configures the specified cache.





### Icybee\Modules\Cache\DisableOperation

Disables the specified cache.





### Icybee\Modules\Cache\EditorOperation

Returns the configuration editor.

The editor is obtained through the `editor` property of the cache.





### Icybee\Modules\Cache\EnableOperation

Enables the specified cache.

The cache is cleared before it is enabled.





### Icybee\Modules\Cache\StatOperation

Returns the usage (memory, files) of the specified cache.





## Event hooks





### Icybee\Modules\Modules\ActivateOperation::process

The caches of ICanBoogie are cleared when modules are activated.





### Icybee\Modules\Modules\DeactivateOperation:process

The caches of ICanBoogie are cleared when modules are deactivated.





----------





## Requirement

The package requires PHP 5.5 or later.





## Installation

The recommended way to install this package is through [Composer](http://getcomposer.org/):

```
$ composer require icybee/module-cache
```





### Cloning the repository

The package is [available on GitHub](https://github.com/Icybee/module-cache), its repository can be
cloned with the following command line:

	$ git clone https://github.com/Icybee/module-cache.git





## Documentation

The package is documented as part of the [Icybee](http://icybee.org/) CMS
[documentation](http://icybee.org/docs/). The documentation for the package and its
dependencies can be generated with the `make doc` command. The documentation is generated in
the `docs` directory using [ApiGen](http://apigen.org/). The package directory can later by
cleaned with the `make clean` command.





## License

The module is licensed under the New BSD License - See the LICENSE file for details.
