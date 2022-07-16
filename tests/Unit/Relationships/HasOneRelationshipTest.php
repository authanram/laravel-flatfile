<?php /** @noinspection PhpUnhandledExceptionInspection, StaticClosureCanBeUsedInspection */

use Authanram\FlatFile\Tests\TestFiles\Models\WithRelationship\BelongsToModel;
use Authanram\FlatFile\Tests\TestFiles\Models\WithRelationship\HasOneModel;

it('supports relationship', function () {
    $model = HasOneModel::find(1);

    $relation = $model->belongsToModel;

    expect($relation)->toBeInstanceOf(BelongsToModel::class);

    $model = HasOneModel::find(2)?->belongsToModel()->create([
        'name' => 'quux',
        'has_many_model_id' => 1,
    ]);

    expect($model)
        ->toBeInstanceOf(BelongsToModel::class)
        ->and($model->getKey())
        ->toEqual(3)
        ->and($model->delete())
        ->toBeTrue();
});
