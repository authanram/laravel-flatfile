<?php

declare(strict_types=1);

namespace Authanram\FlatFile;

use Authanram\FlatFile\Serializers\Serializer;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Filesystem\FilesystemAdapter;
use InvalidArgumentException;

final class FlatFile implements FlatFileContract
{
    private Serializer|string $serializer;

    private FilesystemAdapter|Filesystem $storage;

    public function setStorage(FilesystemAdapter|Filesystem $storage): self
    {
        $this->storage = $storage;

        return $this;
    }

    public function setSerializer(Serializer|string $serializer): self
    {
        throw_if(
            is_subclass_of($serializer, Serializer::class) === false,
            InvalidArgumentException::class,
            sprintf('[%s] must be a subclass of %s', $serializer, Serializer::class),
        );

        $this->serializer = $serializer;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function all(Model $model): array
    {
        $files = $this->storage->files($this->getPathResolver($model)->getRelativePath());

        return collect($files)
            ->map(fn ($path) => $this->serializer::decode($this->storage->get($path)))
            ->toArray();
    }

    public function save(Model $model): bool
    {
        return $this->storage->put(
            $this->getPathResolver($model)->getRelativePathname(),
            $this->serializer::encode($model->getAttributes()),
        );
    }

    public function delete(Model $model): bool
    {
        if (method_exists($model, 'trashed') && $model->{'trashed'}()) {
            return $model->save();
        }

        $pathResolver = $this->getPathResolver($model);

        if (count($this->storage->allFiles($pathResolver->getRelativePath())) === 1) {
            return $this->storage->deleteDirectory($pathResolver->getRelativePath());
        }

        return $this->storage->delete($pathResolver->getRelativePathname());
    }

    private function getPathResolver(Model $model): PathResolver
    {
        return PathResolver::make(
            $model->getTable(),
            (string) ($model->getKey() ?? ''),
            $this->serializer::extension(),
        );
    }
}
