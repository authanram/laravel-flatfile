<?php

declare(strict_types=1);

namespace Authanram\FlatFile\Serializers;

final class JsonSerializer extends Serializer
{
    public static function extension(): string
    {
        return '.json';
    }

    /**
     * @inheritDoc
     */
    public static function decode(string $contents): array
    {
        return json_decode($contents, true, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * @inheritDoc
     */
    public static function encode(array $attributes): string
    {
        return json_encode(
            $attributes,
            JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT,
        );
    }
}
