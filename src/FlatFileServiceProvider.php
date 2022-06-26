<?php

declare(strict_types=1);

namespace Authanram\FlatFile;

use Illuminate\Support\ServiceProvider;

final class FlatFileServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->bootRunningUnitTests();

        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'flatfile');

        $this->publishes([
            __DIR__ . '/../config/config.php' => config_path('flatfile.php'),
        ], 'flatfile');
    }

    private function bootRunningUnitTests(): void
    {
        if ($this->app->runningUnitTests() === false) {
            return;
        }

        $this->mergeConfigFrom(__DIR__ . '/../tests/TestFiles/config.php', 'flatfile');
    }
}
