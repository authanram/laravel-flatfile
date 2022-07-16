<?php /** @noinspection StaticClosureCanBeUsedInspection */

use Authanram\FlatFile\Tests\TestFiles\Models\UuidModel;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

it('supports uuid keys', function () {
    $model = new UuidModel();

    expect($model->incrementing)
        ->toBeFalse()
        ->and($model->getKeyType())
        ->toEqual('string')
        ->and(Str::isUuid($model->getKey()))
        ->toBeTrue();
});

it('writes to storage', function () {
    $model = UuidModel::create([
        'name' => 'some-name',
        'data' => ['some' => 'data'],
    ]);

    $path = __DIR__.'/../../TestFiles/flatfile/uuid_models/'.$model->getKey().'.json';

    expect($model->exists)
        ->toBeTrue()
        ->and(File::exists($path))
        ->toBeTrue()
        ->and($model->delete())
        ->toBeTrue()
        ->and($model->exists)
        ->toBeFalse()
        ->and(File::exists($path))
        ->toBeFalse()
        ->and(File::exists(dirname($path)))
        ->toBeFalse();
});
