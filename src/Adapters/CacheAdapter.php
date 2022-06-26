<?php

declare(strict_types=1);

namespace Authanram\FlatFile\Adapters;

use Authanram\FlatFile\Contracts\FlatFileAdapterContract;
use Illuminate\Database\Eloquent\Model;

final class CacheAdapter implements FlatFileAdapterContract
{
    public function locate(Model|string $model): string
    {
        ray($model);

        return '';
    }

    public function get(Model|string $model): array
    {
        return [];
    }

    public function set(Model $model): bool
    {
        return true;
    }
}
