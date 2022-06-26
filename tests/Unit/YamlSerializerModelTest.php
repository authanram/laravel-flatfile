<?php /** @noinspection PhpUnhandledExceptionInspection, StaticClosureCanBeUsedInspection */

use Authanram\FlatFile\Tests\TestFiles\YamlSerializerModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\File;
use Symfony\Component\Yaml\Yaml;
use function Spatie\Snapshots\assertMatchesSnapshot;

it('retrieves first model', function () {
    $model = YamlSerializerModel::first();

    expect($model)->toBeInstanceOf(YamlSerializerModel::class);

    assertMatchesSnapshot($model?->getAttributes());
});

it('retrieves models', function () {
    $result = YamlSerializerModel::all();

    expect($result)
        ->toBeInstanceOf(Collection::class)
        ->toHaveCount(3)
        ->and($result->first())
        ->toBeInstanceOf(YamlSerializerModel::class);

    assertMatchesSnapshot($result->toArray());
});

it('saves model', function () {
    $model = YamlSerializerModel::create([
        'name' => 'some-name',
        'data' => ['some' => 'data'],
    ]);

    expect($model->exists)->toBeTrue();

    $path = $model::flatFile()
        ->getStorageAdapter()
        ->locate($model);

    expect(File::get($path))
        ->toEqual(Yaml::dump($model->getAttributes()))
        ->and(File::delete($path))
        ->toBeTrue()
        ->and(File::exists($path))
        ->toBeFalse();
});

it('deletes model', function () {
    $model = YamlSerializerModel::create([
        'name' => 'some-name',
        'data' => ['some' => 'data'],
    ]);

    $path = $model::flatFile()
        ->getStorageAdapter()
        ->locate($model);

    expect($model->getKey())
        ->toEqual(4)
        ->and($model->delete())
        ->toBeTrue()
        ->and(File::exists($path))
        ->toBeFalse();
});
