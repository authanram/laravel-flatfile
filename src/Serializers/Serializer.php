<?php

declare(strict_types=1);

namespace Authanram\FlatFile\Serializers;

abstract class Serializer
{
    abstract public static function extension(): string;

    abstract public static function decode(string $contents): array;

    abstract public static function encode(array $attributes): string;
}
