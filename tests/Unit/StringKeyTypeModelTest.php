<?php /** @noinspection PhpUnhandledExceptionInspection, StaticClosureCanBeUsedInspection */

use Authanram\FlatFile\Tests\TestFiles\StringKeyTypeModel;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

it('supports uuid keys', function () {
    $model = new StringKeyTypeModel();

    expect($model->incrementing)
        ->toBeFalse()
        ->and($model->getKeyType())
        ->toEqual('string')
        ->and(Str::isUuid($model->getKey()))
        ->toBeTrue();
});

it('writes to storage', function () {
    $model = StringKeyTypeModel::create([
        'name' => 'some-name',
        'data' => ['some' => 'data'],
    ]);

    $path = (string)flatFile($model)->getPathResolver();

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
