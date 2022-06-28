<?php

declare(strict_types=1);

use Authanram\FlatFile\Serializers\JsonSerializer;

return [

    /*
    |--------------------------------------------------------------------------
    | Disk Configuration
    |--------------------------------------------------------------------------
    |
    | ...
    |
    */

    'disk' => [
        'driver' => 'local',
        'root' => __DIR__.'/../TestFiles/flatfile',
        'throw' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Serializer
    |--------------------------------------------------------------------------
    |
    | ...
    |
    */

    'serializer' => JsonSerializer::class,
];
