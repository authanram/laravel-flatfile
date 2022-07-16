<?php /** @noinspection PhpUnhandledExceptionInspection, StaticClosureCanBeUsedInspection */

use Authanram\FlatFile\Tests\TestFiles\Models\JsonModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\File;
use function Spatie\Snapshots\assertMatchesSnapshot;

beforeEach(function () {
    $this->absolutePathname = __DIR__ . '/../../TestFiles/flatfile/json_models/4.json';
});

it('retrieves first model', function () {
    $model = JsonModel::first();

    expect($model)->toBeInstanceOf(JsonModel::class);

    assertMatchesSnapshot($model?->getAttributes());
});

it('retrieves models', function () {
    $result = JsonModel::all();

    expect($result)
        ->toBeInstanceOf(Collection::class)
        ->toHaveCount(3)
        ->and($result->first())
        ->toBeInstanceOf(JsonModel::class);

    assertMatchesSnapshot($result->toArray());
});

it('saves model', function () {
    $model = JsonModel::create([
        'name' => 'some-name',
        'data' => ['some' => 'data'],
    ]);

    expect($model->exists)
        ->toBeTrue()
        ->and(File::get($this->absolutePathname))
        ->toEqual(json_encode($model->getAttributes(), JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT))
        ->and(File::exists($this->absolutePathname))
        ->toBeTrue();
});

it('deletes model', function () {
    $model = JsonModel::find(4);

    expect($model)
        ->toBeInstanceOf(JsonModel::class)
        ->and($model->delete())
        ->toBeTrue()
        ->and(File::exists($this->absolutePathname))
        ->toBeFalse();
});
