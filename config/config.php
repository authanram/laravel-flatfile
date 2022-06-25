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

    'storage_adapter' => FilesystemAdapter::build([
        'driver' => 'local',
        'root' => __DIR__ . '/flat-file-model',
    ]),

    /*
    |--------------------------------------------------------------------------
    | Serializer
    |--------------------------------------------------------------------------
    |
    | ...
    |
    */

    'serializer' => JsonSerializer::class,

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
