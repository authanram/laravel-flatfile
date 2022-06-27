<?php

declare(strict_types=1);

namespace Authanram\FlatFile;

use Authanram\FlatFile\Serializers\Serializer;
use Authanram\FlatFile\Tests\TestFiles\SoftDeletesModel;
use Throwable;

final class Actions
{
    /**
     * @throws Throwable
     */
    public static function all(FlatFile $flatFile): array
    {
        return collect($flatFile->getStorage()->files($flatFile->getPathResolver()->getRelative()))
            ->map(fn ($path) => self::decode(
                $flatFile->getSerializer(),
                $flatFile->getStorage()->get($path)),
            )->toArray();
    }

    /**
     * @throws Throwable
     */
    public static function save(FlatFile $flatFile): bool
    {
        $contents = self::encode($flatFile->getSerializer(), $flatFile->getModel()->getAttributes());

        return $flatFile->getStorage()->put($flatFile->getPathResolver()->getRelative(), $contents);
    }

    /**
     * @throws Throwable
     */
    public static function delete(FlatFile $flatFile): bool
    {
        if (method_exists($flatFile->getModel(), 'trashed')
        ) {
            dd(333, $flatFile->getModel());
            return true;
        }

        dump($flatFile->getModel());

        return $flatFile->getStorage()->delete($flatFile->getPathResolver()->getRelative());
    }

    private static function decode(Serializer|string $serializer, string $contents): array
    {
        return $serializer::decode($contents);
    }

    private static function encode(Serializer|string $serializer, array $attributes): string
    {
        return $serializer::encode($attributes);
    }
}
