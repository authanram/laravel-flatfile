<?php /** @noinspection StaticClosureCanBeUsedInspection */

use Authanram\FlatFile\Tests\TestFiles\Models\SoftDeletesModel;
use Illuminate\Support\Facades\File;

beforeEach(function () {
    $this->absolutePathname = __DIR__.'/../../TestFiles/flatfile/soft_deletes_models/1.json';
});

it('can be soft-deleted', function () {
    $model = SoftDeletesModel::create([
        'name' => 'some-name',
        'data' => ['some' => 'data'],
    ]);

    expect(SoftDeletesModel::onlyTrashed()->get())
        ->toBeEmpty();

    $model->delete();

    $trashed = SoftDeletesModel::onlyTrashed()->get();

    expect($trashed->first()->getAttributes())
        ->toEqual($model->getAttributes())
        ->and(File::exists($this->absolutePathname))
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

    expect($model)
        ->toBeInstanceOf(SoftDeletesModel::class)
        ->and($model->forceDelete())
        ->toBeTrue()
        ->and(SoftDeletesModel::first())
        ->toBeNull()
        ->and(File::exists($this->absolutePathname))
        ->toBeFalse();
});
