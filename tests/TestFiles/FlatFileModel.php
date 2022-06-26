<?php

namespace Authanram\FlatFile\Tests\TestFiles;

use Eloquent;

class FlatFileModel extends Eloquent
{
    use \Authanram\FlatFile\Concerns\FlatFileModel;

    protected array $schema = [
        'name' => 'string',
        'data' => 'json',
    ];

    protected $fillable = [
        'name',
        'data',
    ];

    protected $casts = [
        'data' => 'array',
    ];
}
