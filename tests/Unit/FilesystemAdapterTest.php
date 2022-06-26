<?php /** @noinspection StaticClosureCanBeUsedInspection */

use Authanram\FlatFile\Adapters\FilesystemAdapter;
use Authanram\FlatFile\Tests\TestFiles\FlatFileModel;
use Illuminate\Support\Facades\File;
use function Spatie\Snapshots\assertMatchesSnapshot;

beforeEach(function () {
    $this->filesystemAdapter = config('flatfile.storage_adapter');
});

it('throws on invalid serializer', function () {
    new FilesystemAdapter([], 'invalid-serializer');
})->expectExceptionMessage('Expected "Authanram\FlatFile\Serializers\Serializer" got: string');

it('locates a models storage directory', function () {
    expect($this->filesystemAdapter->locate(new FlatFileModel))
        ->toEqual(realpath(__DIR__.'/../TestFiles/flatfile/flat-file-model'));
});

it('locates a models flat file', function () {
    expect($this->filesystemAdapter->locate(FlatFileModel::first()))
        ->toEqual(realpath(__DIR__.'/../TestFiles/flatfile/flat-file-model/1.json'));
});

it('reads', function () {
    /** @noinspection PhpUnhandledExceptionInspection */
    $contents = $this->filesystemAdapter->get(new FlatFileModel);

    expect($contents)
        ->toBeArray()
        ->toHaveCount(3);

    assertMatchesSnapshot($contents);
});

it('writes', function () {
    $model = FlatFileModel::create([
        'name' => 'foobar',
        'data' => ['some' => 'data'],
    ]);

    $path = $model::flatFile()
        ->getAdapter()
        ->locate($model);

    expect($this->filesystemAdapter->set($model))
        ->toBeTrue()
        ->and(File::exists($path))
        ->toBeTrue()
        ->and(File::delete($path))
        ->toBeTrue()
        ->and(File::exists($path))
        ->toBeFalse();
});
