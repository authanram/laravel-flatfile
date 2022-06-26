<?php

namespace Authanram\FlatFile\Tests\TestFiles;

use Authanram\FlatFile\Concerns\HasUuidKey;

class FlatFileUuidModel extends FlatFileModel
{
    use HasUuidKey;

    protected array $schema = [
        'id' => 'string',
        'name' => 'string',
        'data' => 'json',
    ];
}
