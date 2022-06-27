<?php /** @noinspection PhpUnhandledExceptionInspection, StaticClosureCanBeUsedInspection */

use Authanram\FlatFile\Tests\TestFiles\SoftDeletesModel;
use Illuminate\Support\Facades\File;

it('can be soft-deleted', function () {
    $model = SoftDeletesModel::create([
        'name' => 'some-name',
        'data' => ['some' => 'data'],
    ]);

    $path = __DIR__.'/../TestFiles/flatfile/soft-deletes-model/1.json';

    expect(SoftDeletesModel::onlyTrashed()->get())
        ->toBeEmpty();

    $model->delete();

    $trashed = SoftDeletesModel::onlyTrashed()->get();

    expect($trashed->first()->getAttributes())
        ->toEqual($model->getAttributes())
        ->and(File::exists($path))
        ->toBeTrue();
});

it('can be restored', function () {
    expect(SoftDeletesModel::onlyTrashed()->first()?->restore())
        ->toBeTrue()
        ->and(SoftDeletesModel::first())
        ->toBeInstanceOf(SoftDeletesModel::class);
});

it('can be force-deleted', function () {
    /** @var SoftDeletesModel $model */
    $model = SoftDeletesModel::first();

    $path = __DIR__.'/../TestFiles/flatfile/soft-deletes-model/1.json';

    expect($model->forceDelete())
        ->toBeTrue()
        ->and(SoftDeletesModel::first())
        ->toBeNull()
        ->and(File::exists($path))
        ->toBeFalse();
});
