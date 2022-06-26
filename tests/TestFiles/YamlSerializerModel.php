<?php

declare(strict_types=1);

namespace Authanram\FlatFile\Tests\TestFiles;

use Authanram\FlatFile\FlatFileModel;
use Authanram\FlatFile\Serializers\YamlSerializer;
use Eloquent;

class YamlSerializerModel extends Eloquent
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
