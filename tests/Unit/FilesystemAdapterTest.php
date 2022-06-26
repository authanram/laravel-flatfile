<?php /** @noinspection PhpUnhandledExceptionInspection, StaticClosureCanBeUsedInspection */

use Authanram\FlatFile\Adapters\FilesystemAdapter;
use Authanram\FlatFile\Tests\TestFiles\JsonSerializerModel;
use Illuminate\Support\Facades\File;
use function Spatie\Snapshots\assertMatchesSnapshot;

beforeEach(function () {
    $this->filesystemAdapter = config('flatfile.storage_adapter');
});

it('throws on invalid serializer', function () {
    new FilesystemAdapter([], 'invalid-serializer');
})->expectExceptionMessage('Expected "Authanram\FlatFile\Serializers\Serializer" got: string');

it('locates the models storage directory', function () {
    expect($this->filesystemAdapter->locate(new JsonSerializerModel))
        ->toEqual(realpath(__DIR__ . '/../TestFiles/flatfile/json-serializer-model'));
});

it('locates the models storage file', function () {
    expect($this->filesystemAdapter->locate(JsonSerializerModel::first()))
        ->toEqual(realpath(__DIR__ . '/../TestFiles/flatfile/json-serializer-model/1.json'));
});

it('reads from the storage', function () {
    /** @noinspection PhpUnhandledExceptionInspection */
    $contents = $this->filesystemAdapter->get(new JsonSerializerModel);

    expect($contents)
        ->toBeArray()
        ->toHaveCount(3);

    assertMatchesSnapshot($contents);
});

it('writes to the storage', function () {
    $model = JsonSerializerModel::create([
        'name' => 'some-name',
        'data' => ['some' => 'data'],
    ]);

    $path = $model::flatFile()->getStorageAdapter()->locate($model);

    expect($this->filesystemAdapter->set($model))
        ->toBeTrue()
        ->and(File::exists($path))
        ->toBeTrue()
        ->and(File::delete($path))
        ->toBeTrue()
        ->and(File::exists($path))
        ->toBeFalse();
});
