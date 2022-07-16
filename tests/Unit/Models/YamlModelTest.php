<?php /** @noinspection PhpUnhandledExceptionInspection, StaticClosureCanBeUsedInspection */

use Authanram\FlatFile\Tests\TestFiles\Models\YamlModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\File;
use Symfony\Component\Yaml\Yaml;
use function Spatie\Snapshots\assertMatchesSnapshot;

beforeEach(function () {
    $this->absolutePathname = __DIR__ . '/../../TestFiles/flatfile/yaml_models/4.yaml';
});

it('retrieves first model', function () {
    $model = YamlModel::first();

    expect($model)->toBeInstanceOf(YamlModel::class);

    assertMatchesSnapshot($model?->getAttributes());
});

it('retrieves models', function () {
    $result = YamlModel::all();

    expect($result)
        ->toBeInstanceOf(Collection::class)
        ->toHaveCount(3)
        ->and($result->first())
        ->toBeInstanceOf(YamlModel::class);

    assertMatchesSnapshot($result->toArray());
});

it('saves model', function () {
    $model = YamlModel::create([
        'name' => 'some-name',
        'data' => ['some' => 'data'],
    ]);

    expect($model->exists)
        ->toBeTrue()
        ->and(File::get($this->absolutePathname))
        ->toEqual(Yaml::dump($model->getAttributes()))
        ->and(File::delete($this->absolutePathname))
        ->toBeTrue()
        ->and(File::exists($this->absolutePathname))
        ->toBeFalse();
});

it('deletes model', function () {
    $model = YamlModel::create([
        'name' => 'some-name',
        'data' => ['some' => 'data'],
    ]);

    expect($model->getKey())
        ->toEqual(4)
        ->and($model->delete())
        ->toBeTrue()
        ->and(File::exists($this->absolutePathname))
        ->toBeFalse();
});
