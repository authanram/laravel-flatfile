<?php

declare(strict_types=1);

namespace Authanram\FlatFile;

use Illuminate\Database\Eloquent\Model;

final class EventHandlers
{
    public static function saved(Model $model): bool
    {
        return self::set($model);
    }

    public static function deleted(Model $model): bool
    {
        return self::set($model);
    }

    private static function set(Model $model): bool
    {
        return $model::{'flatFile'}()
            ->getStorageAdapter()
            ->set($model);
    }
}
