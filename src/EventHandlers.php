<?php

namespace Authanram\FlatFile;

use Illuminate\Database\Eloquent\Model;

final class EventHandlers
{
    public static function saved(Model $model): bool
    {
        return $model::{'flatFile'}()->getAdapter()->set($model);
    }

    public static function deleted(Model $model): bool
    {
        dump(__FUNCTION__);

        return true;
    }
}
