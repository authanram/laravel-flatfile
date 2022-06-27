<?php

declare(strict_types=1);

namespace Authanram\FlatFile\Contracts;

interface AdapterContract
{
    public function all(string $key): array;

    public function put(string $key, string $content): bool;

    public function delete(string $key): bool;
}
