<?php

use Authanram\FlatFile\Adapters\FilesystemAdapter;
use Authanram\FlatFile\Serializers\JsonSerializer;
use Illuminate\Database\Eloquent\Model;

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

    'event_handlers' => [

        'booting' => static function(Model $model) {
        },

        'saved' => static function(Model $model) {
        },

        'deleted' => static function(Model $model) {
        },

    ],
];
