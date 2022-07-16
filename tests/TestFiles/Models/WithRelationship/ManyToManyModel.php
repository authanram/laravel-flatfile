<?php

declare(strict_types=1);

namespace Authanram\FlatFile\Tests\TestFiles\Models\WithRelationship;

use Authanram\FlatFile\FlatFileModel;
use Eloquent;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ManyToManyModel extends Eloquent
{
    use FlatFileModel;

    protected $fillable = [
        'name',
    ];

    public function belongsToModels(): BelongsToMany
    {
        return $this->belongsToMany(BelongsToModel::class);
    }
}
