<?php

declare(strict_types=1);

namespace Authanram\FlatFile\Serializers;

use Symfony\Component\Yaml\Yaml;

final class YamlSerializer extends Serializer
{
    public static function extension(): string
    {
        return '.yaml';
    }

    /**
     * @inheritDoc
     */
    public static function decode(string $contents): array
    {
        return Yaml::parse($contents);
    }

    /**
     * @inheritDoc
     */
    public static function encode(array $attributes): string
    {
        return Yaml::dump($attributes);
    }
}
