<?php /** @noinspection StaticClosureCanBeUsedInspection */

use Authanram\FlatFile\Contracts\FlatFileContract;

beforeEach(function () {
    $this->flatFile = resolve(FlatFileContract::class);
});

it('throws on invalid adapter', function () {
    config()->set('flatfile-model.storage_adapter', 'invalid-value');
    $this->flatFile->getAdapter();
})->expectExceptionMessage('Expected "Authanram\FlatFile\Contracts\FlatFileAdapterContract" got: string');

it('throws on invalid serializer', function () {
    config()->set('flatfile-model.serializer', 'invalid-value');
    $this->flatFile->getSerializer();
})->expectExceptionMessage('Expected "Authanram\FlatFile\Serializers\Serializer" got: string');

it('throws on invalid event handlers', function () {
    config()->set('flatfile-model.event_handlers', ['array', 'list']);
    $this->flatFile->getEventHandlers();
})->expectExceptionMessage('Expected map - associative array with string keys.');

it('gets the adapter', function () {
    expect($this->flatFile->getAdapter()::class)
        ->toEqual(config('flatfile-model.storage_adapter')::class);
});

it('gets the serializer', function () {
    expect($this->flatFile->getSerializer())
        ->toEqual(config('flatfile-model.serializer'));
});

it('gets the event handlers', function () {
    expect($this->flatFile->getEventHandlers())
        ->toEqual(config('flatfile-model.event_handlers'));
});
