<?php

declare(strict_types=1);

use Authanram\FlatFile\FlatFileContract;
use Authanram\FlatFile\Tests\TestCase;
use Illuminate\Database\Eloquent\Model;

uses(TestCase::class)->in('Unit');

function flatFile(Model|string $model): FlatFileContract {
    return resolve(FlatFileContract::class)->setModel($model);
}
