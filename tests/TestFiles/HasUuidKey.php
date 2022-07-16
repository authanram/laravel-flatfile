<?php

declare(strict_types=1);

namespace Authanram\FlatFile\Tests\TestFiles;

use Illuminate\Support\Str;

trait HasUuidKey
{
    /** @noinspection PhpUnused */
    public function initializeHasUuidKey(): void
    {
        $this->incrementing = false;

        $this->keyType = 'string';

        $this->attributes[$this->getKeyName()] ??= Str::orderedUuid()->toString();
    }
}
