<?php

declare(strict_types=1);

namespace Authanram\FlatFile\Tests\TestFiles;

class StringKeyTypeModel extends JsonSerializerModel
{
    use HasUuidKey;

    protected array $schema = [
        'id' => 'string',
        'name' => 'string',
        'data' => 'json',
    ];
}
