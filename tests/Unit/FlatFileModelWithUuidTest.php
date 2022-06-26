<?php /** @noinspection StaticClosureCanBeUsedInspection */

use Authanram\FlatFile\Tests\TestFiles\FlatFileUuidModel;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

it('supports uuid keys', function () {
    $model = new FlatFileUuidModel();

    expect($model->incrementing)
        ->toBeFalse()
        ->and($model->getKeyType())
        ->toEqual('string')
        ->and(Str::isUuid($model->getKey()))
        ->toBeTrue();
});

it('writes to storage', function () {
    $model = FlatFileUuidModel::create([
        'name' => 'foobar',
        'data' => ['some' => 'data'],
    ]);

    $path = $model::flatFile()->getStorageAdapter()->locate($model);

    expect($model->exists)
        ->toBeTrue()
        ->and(File::exists($path))
        ->toBeTrue()
        ->and(basename($path))
        ->toEqual($model->getKey().'.json')
        ->and($model->delete())
        ->toBeTrue()
        ->and($model->exists)
        ->toBeFalse()
        ->and(File::exists($path))
        ->toBeFalse()
        ->and(File::exists(dirname($path)))
        ->toBeFalse();
});
