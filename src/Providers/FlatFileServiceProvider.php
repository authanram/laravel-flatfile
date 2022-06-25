<?php

namespace Authanram\FlatFile\Providers;

use Illuminate\Support\ServiceProvider;
use Authanram\FlatFile\Contracts\FlatFileContract;
use Authanram\FlatFile\FlatFile;

class FlatFileServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(FlatFileContract::class, FlatFile::class);
    }

    public function boot(): void
    {
        $this->bootRunningUnitTests();

        if ($this->app->runningUnitTests()) {
            return;
        }

        $this->mergeConfigFrom(__DIR__ . '/../../config/config.php', 'flatfile');

        $this->publishes([
            __DIR__ . '/../../config/config.php' => config_path('flatfile.php'),
        ], 'flatfile');
    }

    private function bootRunningUnitTests(): void
    {
        if ($this->app->runningUnitTests() === false) {
            return;
        }

        $this->mergeConfigFrom(__DIR__ . '/../../tests/TestFiles/config.php', 'flatfile');
    }
}
