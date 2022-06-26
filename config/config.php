<?php

use Authanram\FlatFile\Adapters\FilesystemAdapter;
use Authanram\FlatFile\EventHandlers;
use Authanram\FlatFile\Serializers\JsonSerializer;

return [

    /*
    |--------------------------------------------------------------------------
    | Storage Adapter
    |--------------------------------------------------------------------------
    |
    | ...
    |
    */

    'storage_adapter' => new FilesystemAdapter([
        'driver' => 'local',
        'root' => storage_path('app/flatfile'),
        'throw' => true,
    ], JsonSerializer::class),

    /*
    |--------------------------------------------------------------------------
    | Event Handlers
    |--------------------------------------------------------------------------
    |
    | ...
    |
    */

    'event_handlers' => [
        'saved' => static function ($model) {
            return EventHandlers::saved($model);
        },
        'deleted' => static function ($model) {
            return EventHandlers::deleted($model);
        },
    ],
];
