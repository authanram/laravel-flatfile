<?php

declare(strict_types=1);

namespace Authanram\FlatFile\Serializers;

use JsonException;

abstract class Serializer
{
    abstract public static function extension(): string;

    /**
     * @return array<string, mixed>
     *
     * @throws JsonException
     *
     * @noinspection PhpDocSignatureIsNotCompleteInspection
     */
    abstract public static function decode(string $contents): array;

    /**
     * @param array<string, mixed> $attributes
     *
     * @throws JsonException
     */
    abstract public static function encode(array $attributes): string;
}
