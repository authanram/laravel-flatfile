<?php /** @noinspection PhpUnhandledExceptionInspection, StaticClosureCanBeUsedInspection */

use Authanram\FlatFile\Tests\TestFiles\Models\WithRelationship\ManyToManyModel;

it('supports relationship', function () {
    /** @noinspection PhpPossiblePolymorphicInvocationInspection */
    ManyToManyModel::find(1)->belongsToModels;
})->skip('Currently not supported.');
