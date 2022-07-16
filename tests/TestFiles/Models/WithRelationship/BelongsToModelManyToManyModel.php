<?php

declare(strict_types=1);

namespace Authanram\FlatFile\Tests\TestFiles\Models\WithRelationship;

use Authanram\FlatFile\FlatFileModel;
use Illuminate\Database\Eloquent\Relations\Pivot;

class BelongsToModelManyToManyModel extends Pivot
{
    use FlatFileModel;

//    protected $fillable = [
//        'belongs_to_model_id',
//        'many_to_many_model_id',
//    ];
//
//    public function belongsToModels(): HasMany
//    {
//        return $this->hasMany(BelongsToModel::class);
//    }
//
//    public function hasManyModels(): HasMany
//    {
//        return $this->hasMany(HasManyModel::class);
//    }
}
