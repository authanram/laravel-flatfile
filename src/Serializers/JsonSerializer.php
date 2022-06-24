<?php

namespace Authanram\FlatFile\Serializers;

use JsonException;

final class JsonSerializer extends Serializer
{
    public static function extension(): string
    {
        return 'json';
    }

    /**
     * @throws JsonException
     */
    public static function decode(string $contents): array
    {
        return json_decode($contents, true, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * @throws JsonException
     */
    public static function encode(array $attributes): string
    {
        return json_encode($attributes, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT);
    }
}
