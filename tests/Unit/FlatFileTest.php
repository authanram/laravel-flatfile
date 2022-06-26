<?php /** @noinspection PhpUnhandledExceptionInspection, StaticClosureCanBeUsedInspection */

use Authanram\FlatFile\FlatFile;

beforeEach(function () {
    /** @noinspection PhpUnhandledExceptionInspection */
    $this->flatFile = (new FlatFile())
        ->setStorageAdapter(config('flatfile.storage_adapter'))
        ->setEventHandlers(config('flatfile.event_handlers'));
});

it('throws on invalid event handlers', function () {
    $this->flatFile->setEventHandlers(['array', 'list']);
})->expectExceptionMessage('Expected map - associative array with string keys.');

it('gets the storage adapter', function () {
    expect($this->flatFile->getStorageAdapter()::class)
        ->toEqual(config('flatfile.storage_adapter')::class);
});

it('gets the event handlers', function () {
    $subject = $this->flatFile->getEventHandlers();

    $result = (is_array($subject) && array_is_list($subject) === false)
        || (is_string($subject) && class_exists($subject));

    expect($result)->toBeTrue();
});
