<?php

declare(strict_types=1);

namespace Authanram\FlatFile;

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
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'flatfile');

        $this->publishes([
            __DIR__ . '/../config/config.php' => config_path('flatfile.php'),
        ], 'flatfile');
    }
}
