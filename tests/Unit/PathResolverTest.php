<?php /** @noinspection StaticClosureCanBeUsedInspection */

use Authanram\FlatFile\PathResolver;

beforeEach(function () {
    $this->absolutePathname = realpath(__DIR__ . '/../TestFiles/flatfile/json_models/1.json');
});

it('resolves a models storage directory', function () {
    expect((string)PathResolver::make('json_models', '', '.json'))
        ->toEqual(dirname($this->absolutePathname));
});

it('resolves a models storage paths', function () {
    $pathResolver = PathResolver::make('json_models', 1, '.json');

    expect((string)$pathResolver)
        ->toEqual($this->absolutePathname)

        // absolute pathname
        ->and($pathResolver->getAbsolutePathname())
        ->toEqual($this->absolutePathname)

        // relative pathname
        ->and($pathResolver->getRelativePathname())
        ->toEqual('json_models/'.basename($this->absolutePathname))

        // absolute path
        ->and($pathResolver->getAbsolutePath())
        ->toEqual(dirname($this->absolutePathname))

        // relative path
        ->and($pathResolver->getRelativePath())
        ->toEqual('json_models')

        // filename
        ->and($pathResolver->getFilename())
        ->toEqual(basename($this->absolutePathname));
});
