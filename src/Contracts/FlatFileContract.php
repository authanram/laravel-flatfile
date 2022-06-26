<?php

namespace Authanram\FlatFile\Contracts;

use Authanram\FlatFile\Contracts\FlatFileAdapterContract as AdapterContract;

interface FlatFileContract
{
    public function getStorageAdapter(): FlatFileAdapterContract;

    public function setStorageAdapter(AdapterContract $storageAdapter): self;

    public function getEventHandlers(): array;

    public function setEventHandlers(array|string $eventHandlers): self;
}
