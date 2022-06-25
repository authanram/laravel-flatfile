<?php

namespace Authanram\FlatFile;

use Illuminate\Database\Eloquent\Model;

final class EventHandlers
{
    public static function saved(Model $model): bool
    {
        dump(__FUNCTION__);
//        dump([__FUNCTION__ => $model]);

        return true;
    }

    public static function deleted(Model $model): bool
    {
        dump(__FUNCTION__);
//        dump([__FUNCTION__ => $model]);

        return true;
    }
}
