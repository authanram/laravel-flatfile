# authanram/laravel-flatfile

[![CI](https://github.com/authanram/laravel-flatfile/actions/workflows/main.yml/badge.svg)](https://github.com/authanram/laravel-flatfile/actions/workflows/main.yml)

Eloquent flat file driver, on top of [Sushi 🍣](https://github.com/calebporzio/sushi).

## Requirements

PHP 8.1.4 or higher, [Laravel 9+](https://laravel.com/docs/9.x)

## Installation

You can install the package via composer.

```shell
composer require authanram/laravel-flatfile
```

By default all files written by this package will be located at `storage_path('app/flatfile')`.

Publish the [package configuration](config/config.php):

```shell
php artisan vendor:publish --provider="Authanram\FlatFile\FlatFileServiceProvider"
```

## Basic Usage Example

Here's an example of how it can be used in a very basic way:

```php
namespace App\Models;

use Authanram\FlatFile\FlatFileModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use FlatFileModel;
    use SoftDeletes;
    
    protected $schema = [
        'title' => 'string',
        'body' => 'string',
        'published_at' => 'datetime',
    ];
    
    protected $fillable = [
        'title',
        'body',
        'published_at',
    ];
}
```

Somewhere else in your code:

```php
use App\Models\Post;

Post::create([
    'title' => 'New package arrived: laravel-flatfile',
    'body' => 'Solving the issue of...',
    'published_at' => now()->addHour(),
])
```

This will store the following contents to `storage_path('app/flatfile/post/1.json')`:

```json
{\n
    "id": 1,\n
    "title": "New package arrived: laravel-flatfile",\n
    "body": "Solving the issue of...",\n
    "published_at": "2022-06-26T00:03:18.105800Z",\n
    "created_at": "2022-06-26T23:03:18.105800Z",\n
    "updated_at": "2022-06-26T23:03:18.105800Z",\n
    "deleted_at": null\n
}
```

For now the package ships a second serializer, supporting yaml.

To utilize this serializer, change the configuration as follows:

```php
use Authanram\FlatFile\Serializers\YamlSerializer;

'storage_adapter' => new FilesystemAdapter([
    'driver' => 'local',
    'root' => storage_path('app/flatfile'),
    'throw' => true,
], YamlSerializer::class),
```

As this example may indicate, at this point we provide an [on-demand disk](https://laravel.com/docs/9.x/filesystem#on-demand-disks)
instance to the package, to access the underlying filesystem.

To hook into [eloquent's model events](https://laravel.com/docs/9.x/eloquent#events), you can
adapt the following to go along with your needs:

```php
'event_handlers' => [
    'saved' => static function ($model) {
        return EventHandlers::saved($model);
    },
    'deleted' => static function ($model) {
        return EventHandlers::deleted($model);
    },
],
```

## Contributing

Please see the [contribution guide](https://github.com/authanram/laravel-flatfile/blob/master/.github/CONTRIBUTING.md)
for details.

## Security Vulnerabilities

Please review [our security policy](https://github.com/authanram/laravel-flatfile/security/policy)
on how to report security vulnerabilities.

## Credits

- [Daniel Seuffer](https://github.com/authanram)
- [and Contributors](https://github.com/authanram/laravel-flatfile/graphs/contributors) &nbsp;❤️

Special thanks to [Caleb Porzio](https://github.com/calebporzio), the author of the underlying
package [Sushi 🍣](https://github.com/calebporzio/sushi).

## License

The MIT License (MIT). Please see [License File](https://github.com/authanram/laravel-flatfile/blob/master/LICENSE.md)
for more information.
