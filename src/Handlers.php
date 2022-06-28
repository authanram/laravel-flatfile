<?php

declare(strict_types=1);

namespace Authanram\FlatFile;

use Throwable;

final class Handlers
{
    /**
     * @throws Throwable
     */
    public static function all(FlatFile $flatFile): array
    {
        $files = $flatFile->getStorage()
            ->files($flatFile->getPathResolver()->getRelativePath());

        $decode = static fn ($contents) => $flatFile
            ->getSerializer()::decode($contents);

        return collect($files)
            ->map(fn ($path) => $decode($flatFile->getStorage()->get($path)))
            ->toArray();
    }

    /**
     * @throws Throwable
     */
    public static function save(FlatFile $flatFile): bool
    {
        return $flatFile->getStorage()->put(
            $flatFile->getPathResolver()->getRelativePathname(),
            $flatFile->getSerializer()::encode($flatFile->getModel()->getAttributes()),
        );
    }

    /**
     * @throws Throwable
     */
    public static function delete(FlatFile $flatFile): bool
    {
        $model = $flatFile->getModel();

        if (method_exists($model, 'trashed') && $model->{'trashed'}()) {
            return $model->save();
        }

        $storage = $flatFile->getStorage();

        $relativePath = $flatFile->getPathResolver()->getRelativePath();

        if (count($storage->allFiles($relativePath)) === 1) {
            $storage->deleteDirectory($relativePath);
        }

        return $storage->delete(
            $flatFile->getPathResolver()->getRelativePathname(),
        );
    }
}
