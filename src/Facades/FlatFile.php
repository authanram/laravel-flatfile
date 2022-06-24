<?php

namespace Authanram\FlatFile\Facades;

use Illuminate\Support\Facades\Facade;
use Authanram\FlatFile\Contracts\FlatFileContract;

final class FlatFile extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return FlatFileContract::class;
    }
}
