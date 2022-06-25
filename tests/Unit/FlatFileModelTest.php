<?php /** @noinspection StaticClosureCanBeUsedInspection */

use Authanram\FlatFile\Tests\TestFiles\FlatFileModel;

it('saves model', function () {
    $model = new FlatFileModel;

    $model->save();

    expect(true)->toBeTrue();
});

it('deletes model', function () {
    $model = FlatFileModel::first();

    $model?->delete();

    expect(true)->toBeTrue();
});
