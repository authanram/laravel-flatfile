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
        'root' => __DIR__ . '/flatfile',
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

    'event_handlers' => EventHandlers::class,
];
