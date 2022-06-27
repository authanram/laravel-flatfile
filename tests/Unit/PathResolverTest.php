<?php /** @noinspection PhpUnhandledExceptionInspection, StaticClosureCanBeUsedInspection */

use Authanram\FlatFile\PathResolver;
use Authanram\FlatFile\Serializers\JsonSerializer;
use Authanram\FlatFile\Tests\TestFiles\JsonSerializerModel;

it('resolves a models storage directory', function () {
    $result = (string)PathResolver::make(
        JsonSerializerModel::class,
        config('flatfile.disk.root'),
        JsonSerializer::extension(),
    );

    expect($result)->toEqual(realpath(__DIR__.'/../TestFiles/flatfile/json-serializer-model'));
});

it('resolves a models storage paths', function () {
    $pathResolver = PathResolver::make(
        (new JsonSerializerModel())->forceFill(['id' => 7]),
        config('flatfile.disk.root'),
        JsonSerializer::extension(),
    );

    expect((string)$pathResolver)
        ->toEqual(realpath(__DIR__.'/../TestFiles/flatfile/json-serializer-model').'/7.json')
        ->and($pathResolver->getAbsolute())
        ->toEqual(realpath(__DIR__.'/../TestFiles/flatfile'))
        ->and($pathResolver->getRelative())
        ->toEqual('json-serializer-model/7.json');
});
