<?php

namespace Authanram\FlatFile\Contracts;

use Authanram\FlatFile\Serializers\Serializer;

interface FlatFileContract
{
    public function getAdapter(): FlatFileAdapterContract;

    public function getSerializer(): Serializer|string;

    public function getEventHandlers(): array;
}
