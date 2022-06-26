<?php

declare(strict_types=1);

namespace Authanram\FlatFile\Tests;

use Authanram\FlatFile\Contracts\FlatFileAdapterContract;
use Authanram\FlatFile\FlatFileServiceProvider;

/**
 * @property FlatFileAdapterContract $filesystemAdapter
 */
abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            FlatFileServiceProvider::class,
        ];
    }
}
