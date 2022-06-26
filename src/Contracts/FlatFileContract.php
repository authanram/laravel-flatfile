<?php

namespace Authanram\FlatFile\Contracts;

interface FlatFileContract
{
    public function getStorageAdapter(): FlatFileAdapterContract;

    public function getEventHandlers(): array;
}
