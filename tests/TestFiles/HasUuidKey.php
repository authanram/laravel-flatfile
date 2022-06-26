<?php

namespace Authanram\FlatFile\Tests\TestFiles;

use Illuminate\Support\Str;

trait HasUuidKey
{
    public function initializeHasUuidKey(): void
    {
        $this->incrementing = false;

        $this->keyType = 'string';

        $this->attributes[$this->getKeyName()] ??= Str::orderedUuid()->toString();
    }
}
