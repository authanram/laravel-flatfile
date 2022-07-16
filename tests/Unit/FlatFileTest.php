<?php /** @noinspection PhpUnhandledExceptionInspection, StaticClosureCanBeUsedInspection */

use Authanram\FlatFile\FlatFileContract;
use Authanram\FlatFile\Serializers\JsonSerializer;
use Authanram\FlatFile\Tests\TestFiles\Models\JsonModel;
use Illuminate\Support\Facades\File;
use function Spatie\Snapshots\assertMatchesSnapshot;

beforeEach(function () {
    $this->absolutePathname = __DIR__.'/../TestFiles/flatfile/json_models/4.json';

    $this->flatFile = resolve(FlatFileContract::class)
        ->setSerializer(JsonSerializer::class);
});

it('gets all models by classname', function () {
    assertMatchesSnapshot($this->flatFile->all(new JsonModel));
});

it('writes by model instance', function () {
    $model = (new JsonModel())->forceFill([
        'id' => 4,
        'name' => 'foobar',
        'data' => ['some' => 'data'],
        'created_at' => now()->toString(),
        'updated_at' => now()->toString(),
    ]);

    $this->flatFile->save($model);

    expect(File::exists($this->absolutePathname))
        ->toBeTrue();
});

it('deletes by model instance', function () {
    $model = JsonModel::find(4);

    expect($model)
        ->toBeInstanceOf(JsonModel::class)
        ->and($this->flatFile->delete($model))
        ->toBeTrue()
        ->and(File::exists($this->absolutePathname))
        ->toBeFalse();
});
