<?php

declare(strict_types=1);

namespace Authanram\FlatFile;

use Authanram\FlatFile\Serializers\Serializer;
use Throwable;

final class Actions
{
    /**
     * @throws Throwable
     */
    public static function all(FlatFile $flatFile): array
    {
        $files = $flatFile->getStorage()->files(
            $flatFile->getPathResolver()->getRelativePath(),
        );

        return collect($files)
            ->map(fn ($path) => self::decode(
                $flatFile->getSerializer(),
                $flatFile->getStorage()->get($path)),
            )->toArray();
    }

    /**
     * @throws Throwable
     */
    public static function saved(FlatFile $flatFile): bool
    {
        $contents = self::encode(
            $flatFile->getSerializer(),
            $flatFile->getModel()->getAttributes(),
        );

        return $flatFile->getStorage()->put(
            $flatFile->getPathResolver()->getRelativePathname(),
            $contents,
        );
    }

    /**
     * @throws Throwable
     */
    public static function deleted(FlatFile $flatFile): bool
    {
        if (method_exists($flatFile->getModel(), 'trashed')
            && $flatFile->getModel()->{'trashed'}()
        ) {
            return $flatFile->getModel()->save();
        }

        $relativePath = $flatFile->getPathResolver()->getRelativePath();

        if (count($flatFile->getStorage()->allFiles($relativePath)) === 1) {
            $flatFile->getStorage()->deleteDirectory($relativePath);
        }

        return $flatFile->getStorage()->delete($flatFile->getPathResolver()->getRelativePathname());
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
