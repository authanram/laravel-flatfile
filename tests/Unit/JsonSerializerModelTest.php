<?php /** @noinspection PhpUnhandledExceptionInspection, StaticClosureCanBeUsedInspection */

use Authanram\FlatFile\Tests\TestFiles\JsonSerializerModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\File;
use function Spatie\Snapshots\assertMatchesSnapshot;

it('retrieves first model', function () {
    $model = JsonSerializerModel::first();

    expect($model)->toBeInstanceOf(JsonSerializerModel::class);

    assertMatchesSnapshot($model?->getAttributes());
});

it('retrieves models', function () {
    $result = JsonSerializerModel::all();

    expect($result)
        ->toBeInstanceOf(Collection::class)
        ->toHaveCount(3)
        ->and($result->first())
        ->toBeInstanceOf(JsonSerializerModel::class);

    assertMatchesSnapshot($result->toArray());
});

it('saves model', function () {
    $model = JsonSerializerModel::create([
        'name' => 'some-name',
        'data' => ['some' => 'data'],
    ]);

    expect($model->exists)->toBeTrue();

    $path = $model::flatFile()
        ->getStorageAdapter()
        ->locate($model);

    /**
     * @noinspection PhpUnhandledExceptionInspection
     * @noinspection JsonEncodingApiUsageInspection
     */
    expect(File::get($path))
        ->toEqual(json_encode($model->getAttributes(), JSON_PRETTY_PRINT))
        ->and(File::delete($path))
        ->toBeTrue()
        ->and(File::exists($path))
        ->toBeFalse();
});

it('deletes model', function () {
    $model = JsonSerializerModel::create([
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
