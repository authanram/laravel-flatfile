<?php

namespace Authanram\FlatFile\Concerns;

use Authanram\FlatFile\Contracts\FlatFileContract;
use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

trait FlatModel
{
    use Sushi;

    public static function bootFlatModel(): void
    {
        collect(static::flatFile()->getEventHandlers())
            ->each(function (callable $handler, string $name) {
                static::{$name}(static fn (Model $model) => $handler($model));
            });
    }

    public static function flatFile(): FlatFileContract
    {
        return resolve(FlatFileContract::class);
    }

    public function getRows(): array
    {
        return static::flatFile()
            ->getStorageAdapter()
            ->get($this::class);
    }
}
