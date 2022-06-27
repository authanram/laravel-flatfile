<?php /** @noinspection PhpUnhandledExceptionInspection, StaticClosureCanBeUsedInspection */

use Authanram\FlatFile\FlatFile;
use Authanram\FlatFile\PathResolver;
use Authanram\FlatFile\Tests\TestFiles\JsonSerializerModel;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    /** @noinspection PhpUnhandledExceptionInspection */
    $this->flatFile = (new FlatFile())
        ->setModel(JsonSerializerModel::class)
        ->setSerializer(config('flatfile.serializer'))
        ->setStorage(Storage::build(config('flatfile.disk')));
});

it('gets the model', function () {
    expect($this->flatFile->getModel())
        ->toEqual(JsonSerializerModel::class);
});

it('gets the path resolver', function () {
    expect($this->flatFile->getPathResolver())
        ->toBeInstanceOf(PathResolver::class);
});

it('gets the storage', function () {
    expect($this->flatFile->getStorage())
        ->toBeInstanceOf(FilesystemAdapter::class)
        ->and($this->flatFile->getStorage()->getConfig())
        ->toEqual(config('flatfile.disk'));
});
