<?php /** @noinspection StaticClosureCanBeUsedInspection */

use Authanram\FlatFile\Tests\TestFiles\FlatFileModel;

test('basic test', function () {
    $collection = FlatFileModel::all();

    //dump($collection);

    expect(true)->toBeTrue();
});
