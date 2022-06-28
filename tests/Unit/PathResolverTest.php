<?php /** @noinspection PhpUnhandledExceptionInspection, StaticClosureCanBeUsedInspection */

use Authanram\FlatFile\PathResolver;
use Authanram\FlatFile\Serializers\JsonSerializer;
use Authanram\FlatFile\Tests\TestFiles\JsonSerializerModel;

beforeEach(function () {
    $this->absolutePathname = realpath(__DIR__.'/../TestFiles/flatfile/json-serializer-model/1.json');
});

it('resolves a models storage directory', function () {
    $result = (string)PathResolver::make(
        JsonSerializerModel::class,
        config('flatfile.disk.root'),
        JsonSerializer::extension(),
    );

    expect($result)->toEqual(dirname($this->absolutePathname));
});

it('resolves a models storage paths', function () {
    $pathResolver = PathResolver::make(
        JsonSerializerModel::first(),
        config('flatfile.disk.root'),
        JsonSerializer::extension(),
    );

    expect((string)$pathResolver)
        ->toEqual($this->absolutePathname)

        ->and($pathResolver->getAbsolutePathname())
        ->toEqual($this->absolutePathname)

        ->and($pathResolver->getRelativePathname())
        ->toEqual('json-serializer-model/'.basename($this->absolutePathname))

        ->and($pathResolver->getAbsolutePath())
        ->toEqual(dirname($this->absolutePathname))

        ->and($pathResolver->getRelativePath())
        ->toEqual('json-serializer-model')

        ->and($pathResolver->getFilename())
        ->toEqual(basename($this->absolutePathname));
});
