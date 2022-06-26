<?php /** @noinspection StaticClosureCanBeUsedInspection */

use Authanram\FlatFile\Tests\TestFiles\FlatFileModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\File;
use function Spatie\Snapshots\assertMatchesSnapshot;

it('retrieves first model', function () {
    $model = FlatFileModel::first();

    expect($model)->toBeInstanceOf(FlatFileModel::class);

    assertMatchesSnapshot($model?->getAttributes());
});

it('retrieves models', function () {
    $result = FlatFileModel::all();

    expect($result)
        ->toBeInstanceOf(Collection::class)
        ->toHaveCount(3)
        ->and($result->first())
        ->toBeInstanceOf(FlatFileModel::class);

    assertMatchesSnapshot($result->toArray());
});

it('saves model', function () {
    $model = FlatFileModel::create([
        'name' => 'foobar',
        'data' => [
            'some-data' => 'as json',
            'some-float' => 777,
        ],
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
        ->toEqual(json_encode($model->getAttributes(), JSON_PRETTY_PRINT));
});

it('deletes model', function () {
    $model = FlatFileModel::latest()->first();

    expect($model?->getKey())
        ->toEqual(4)
        ->and($model?->delete())
        ->toBeTrue()
        ->and(File::exists(__DIR__.'/../TestFiles/flatfile/flat-file-model/4.json'))
        ->toBeFalse();
});
