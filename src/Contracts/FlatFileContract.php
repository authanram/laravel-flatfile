<?php

namespace Authanram\FlatFile\Contracts;

interface FlatFileContract
{
    public function getAdapter(): FlatFileAdapterContract;

    public function getEventHandlers(): array;
}
