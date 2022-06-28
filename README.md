# authanram/laravel-flatfile

[![CI](https://github.com/authanram/laravel-flatfile/actions/workflows/main.yml/badge.svg)](https://github.com/authanram/laravel-flatfile/actions/workflows/main.yml)

Eloquent flat file driver, on top of [Sushi 🍣](https://github.com/calebporzio/sushi).

## Requirements

PHP 8.1.4 or higher, [Laravel 9+](https://laravel.com/docs/9.x)

_Downward compatibility is already at the doorstep._

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

Quickly examining the configuration file `config/flatfile.php` would be a good idea.

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
{
    "id": 1,
    "title": "New package arrived: laravel-flatfile",
    "body": "Solving the issue of...",
    "published_at": "2022-06-26 11:29:27",
    "created_at": "2022-06-26 10:29:27",
    "updated_at": "2022-06-26 10:29:27",
    "deleted_at": null
}
```

The package ships a second serializer, supporting yaml, that would lead to the following file
contents stored at `storage_path('app/flatfile/post/1.yaml')`:

```yaml
id: 1
title: New package arrived: laravel-flatfile
body: Solving the issue of...
published_at: 2022-06-26 11:29:27
created_at: '2022-06-26 10:29:27'
updated_at: '2022-06-26 10:29:27'
deleted_at: null
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
