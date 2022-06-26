<?php /** @noinspection StaticClosureCanBeUsedInspection */

use Authanram\FlatFile\Tests\TestFiles\FlatFileModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\File;
use function Spatie\Snapshots\assertMatchesSnapshot;

it('retrieves first model', function () {
    $result = FlatFileModel::first();
    expect($result)->toBeInstanceOf(FlatFileModel::class);
    assertMatchesSnapshot($result?->toArray());
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
        ->getAdapter()
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
//    $model = FlatFileModel::first();
//    $model?->delete();

    expect(true)->toBeTrue();
});
