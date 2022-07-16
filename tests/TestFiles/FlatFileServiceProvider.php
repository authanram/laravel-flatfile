<?php

declare(strict_types=1);

namespace Authanram\FlatFile\Tests\TestFiles;

use Authanram\FlatFile\FlatFileServiceProvider as ServiceProvider;

final class FlatFileServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        config()->set('ide-helper.model_locations', [__DIR__.'/Models']);

        $this->mergeConfigFrom(__DIR__ . '/../TestFiles/config.php', 'flatfile');

        parent::boot();
    }
}
