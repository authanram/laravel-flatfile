<?php

namespace Authanram\FlatFile\Adapters;

use Illuminate\Database\Eloquent\Model;
use Authanram\FlatFile\Contracts\FlatFileAdapterContract;

final class CacheAdapter implements FlatFileAdapterContract
{
    public function locate(Model|string $model): string
    {
        return '';
    }

    public function get(Model|string $model): array
    {
        return [];
    }

    public function set(Model $model): FlatFileAdapterContract
    {
        return $this;
    }
}
