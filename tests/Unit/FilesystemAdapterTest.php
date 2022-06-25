<?php /** @noinspection StaticClosureCanBeUsedInspection */

use Authanram\FlatFile\Contracts\FlatFileContract;
use Authanram\FlatFile\Tests\TestFiles\FlatFileModel;

beforeEach(function () {
    $this->flatFile = resolve(FlatFileContract::class);
});

test('it reads', function () {
//    $location = $this->flatFile->getAdapter()->locate(FlatFileModel::class);
//    dd($location);

    expect(true)->toBeTrue();
});

test('it writes', function () {
    expect(true)->toBeTrue();
});
