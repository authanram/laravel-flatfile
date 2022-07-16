<?php

declare(strict_types=1);

namespace Authanram\FlatFile\Tests\TestFiles\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class SoftDeletesModel extends JsonModel
{
    use SoftDeletes;

    protected array $schema = [
        'name' => 'string',
        'data' => 'json',
        'deleted_at' => 'datetime',
    ];
}
