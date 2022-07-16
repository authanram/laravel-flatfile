<?php

declare(strict_types=1);

namespace Authanram\FlatFile\Tests\TestFiles\Models;

use Authanram\FlatFile\FlatFileModel;
use Authanram\FlatFile\Serializers\YamlSerializer;
use Eloquent;

class YamlModel extends Eloquent
{
    use FlatFileModel;

    protected static $flatFileSerializer = YamlSerializer::class;

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
