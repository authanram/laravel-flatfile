<?php /** @noinspection PhpUnhandledExceptionInspection, StaticClosureCanBeUsedInspection */

use Authanram\FlatFile\Tests\TestFiles\Models\WithRelationship\BelongsToModel;
use Authanram\FlatFile\Tests\TestFiles\Models\WithRelationship\HasManyModel;

it('supports relationship', function () {
    $model = HasManyModel::find(1);

    $relations = $model->belongsToModels;

    expect($relations)
        ->toHaveCount(2)
        ->and($relations[0])
        ->toBeInstanceOf(BelongsToModel::class)
        ->and($relations[1])
        ->toBeInstanceOf(BelongsToModel::class);

    $model = $model?->belongsToModels()->create([
        'name' => 'quux',
        'has_one_model_id' => 1,
    ]);

    expect($model)
        ->toBeInstanceOf(BelongsToModel::class)
        ->and($model->getKey())
        ->toEqual(3)
        ->and($model->delete())
        ->toBeTrue();
});
