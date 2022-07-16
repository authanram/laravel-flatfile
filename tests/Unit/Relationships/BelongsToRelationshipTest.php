<?php /** @noinspection PhpUnhandledExceptionInspection, StaticClosureCanBeUsedInspection */

use Authanram\FlatFile\Tests\TestFiles\Models\WithRelationship\BelongsToModel;
use Authanram\FlatFile\Tests\TestFiles\Models\WithRelationship\HasOneModel;

it('supports relationship', function () {
    $model = BelongsToModel::find(1);

    $relation = $model->hasOneModel;

    expect($relation)->toBeInstanceOf(HasOneModel::class);
});
