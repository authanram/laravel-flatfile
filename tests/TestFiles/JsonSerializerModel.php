<?php

declare(strict_types=1);

namespace Authanram\FlatFile\Tests\TestFiles;

use Authanram\FlatFile\FlatFileModel;
use Eloquent;

class JsonSerializerModel extends Eloquent
{
    use FlatFileModel;

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
