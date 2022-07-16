<?php

declare(strict_types=1);

namespace Authanram\FlatFile\Tests\TestFiles\Models\WithRelationship;

use Authanram\FlatFile\FlatFileModel;
use Eloquent;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HasManyModel extends Eloquent
{
    use FlatFileModel;

    protected $fillable = [
        'name',
    ];

    public function belongsToModels(): HasMany
    {
        return $this->hasMany(BelongsToModel::class);
    }
}
