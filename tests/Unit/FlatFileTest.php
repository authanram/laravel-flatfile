<?php /** @noinspection StaticClosureCanBeUsedInspection */

use Authanram\FlatFile\Contracts\FlatFileContract;

beforeEach(function () {
    $this->flatFile = resolve(FlatFileContract::class);
});

it('throws on invalid adapter', function () {
    config()->set('flatfile.storage_adapter', 'invalid-value');
    $this->flatFile->getAdapter();
})->expectExceptionMessage('Expected "Authanram\FlatFile\Contracts\FlatFileAdapterContract" got: string');

it('throws on invalid serializer', function () {
    config()->set('flatfile.serializer', 'invalid-value');
    $this->flatFile->getSerializer();
})->expectExceptionMessage('Expected "Authanram\FlatFile\Serializers\Serializer" got: string');

it('throws on invalid event handlers', function () {
    config()->set('flatfile.event_handlers', ['array', 'list']);
    $this->flatFile->getEventHandlers();
})->expectExceptionMessage('Expected map - associative array with string keys.');

it('gets the adapter', function () {
    expect($this->flatFile->getAdapter()::class)
        ->toEqual(config('flatfile.storage_adapter')::class);
});

it('gets the serializer', function () {
    expect($this->flatFile->getSerializer())
        ->toEqual(config('flatfile.serializer'));
});

it('gets the event handlers', function () {
    $subject = $this->flatFile->getEventHandlers();

    $result = (is_array($subject) && array_is_list($subject) === false)
        || (is_string($subject) && class_exists($subject));

    expect($result)->toBeTrue();
});
