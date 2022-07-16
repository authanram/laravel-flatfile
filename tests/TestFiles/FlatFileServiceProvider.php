<?php

declare(strict_types=1);

namespace Authanram\FlatFile\Tests\TestFiles;

use Authanram\FlatFile\FlatFile;
use Authanram\FlatFile\FlatFileContract;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;

final class FlatFileServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(FlatFileContract::class, function () {
            return (new FlatFile())
                ->setStorage(Storage::build(config('flatfile.disk')));
        });
    }

    public function boot(): void
    {
        config()->set('ide-helper.model_locations', [__DIR__.'/Models']);

        $this->mergeConfigFrom(__DIR__ . '/../TestFiles/config.php', 'flatfile');
    }
}
