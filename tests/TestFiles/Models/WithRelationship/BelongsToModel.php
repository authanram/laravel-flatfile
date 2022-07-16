<?php

declare(strict_types=1);

namespace Authanram\FlatFile\Tests\TestFiles\Models\WithRelationship;

use Authanram\FlatFile\FlatFileModel;
use Eloquent;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class BelongsToModel extends Eloquent
{
    use FlatFileModel;

    protected $fillable = [
        'name',
        'has_many_model_id',
        'has_one_model_id',
    ];

    public function manyToManyModels(): BelongsToMany
    {
        return $this->belongsToMany(ManyToManyModel::class);
    }

    public function hasManyModels(): BelongsTo
    {
        return $this->belongsTo(HasManyModel::class);
    }

    public function hasOneModel(): BelongsTo
    {
        return $this->belongsTo(HasOneModel::class);
    }
}
