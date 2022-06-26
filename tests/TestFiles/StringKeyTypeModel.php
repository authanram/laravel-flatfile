<?php

namespace Authanram\FlatFile\Tests\TestFiles;

class StringKeyTypeModel extends FlatFileModel
{
    use HasUuidKey;

    protected array $schema = [
        'id' => 'string',
        'name' => 'string',
        'data' => 'json',
    ];
}
