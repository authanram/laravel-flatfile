<?php

use Authanram\FlatFile\Adapters\FilesystemAdapter;
use Authanram\FlatFile\Contracts\FlatFileAdapterContract as Adapter;
use Authanram\FlatFile\Serializers\JsonSerializer;
use Authanram\FlatFile\Serializers\Serializer;
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
        'root' => __DIR__ . '/flatfile',
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

        'saving' => static function(Model $model) {
            dump(['saving' => $model]);
        },

        'saved' => static function(Model $model) {
            dump(['saved' => $model]);
        },

        'deleting' => static function(Model $model) {
            dump(['deleting' => $model]);
        },

        'deleted' => static function(Model $model) {
            dump(['deleted' => $model]);
        },

    ],
];
