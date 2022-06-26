<?php

declare(strict_types=1);

namespace Authanram\FlatFile\Contracts;

use Illuminate\Database\Eloquent\Model;

interface FlatFileAdapterContract
{
    public function locate(Model|string $model): string;

    public function get(Model|string $model): array;

    public function set(Model $model): bool;
}
