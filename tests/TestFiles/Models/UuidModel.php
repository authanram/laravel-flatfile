<?php

declare(strict_types=1);

namespace Authanram\FlatFile\Tests\TestFiles\Models;

use Authanram\FlatFile\Tests\TestFiles\HasUuidKey;

class UuidModel extends JsonModel
{
    use HasUuidKey;

    protected array $schema = [
        'id' => 'string',
        'name' => 'string',
        'data' => 'json',
    ];
}
