<?php

declare(strict_types=1);

namespace Authanram\FlatFile\Tests\TestFiles\Models\WithRelationship;

use Authanram\FlatFile\FlatFileModel;
use Eloquent;
use Illuminate\Database\Eloquent\Relations\HasOne;

class HasOneModel extends Eloquent
{
    use FlatFileModel;

    protected $fillable = [
        'name',
    ];

    public function belongsToModel(): HasOne
    {
        return $this->hasOne(BelongsToModel::class);
    }
}
