<?php

declare(strict_types=1);

namespace Authanram\FlatFile;

use Authanram\FlatFile\Contracts\FlatFileContract;
use Authanram\FlatFile\Serializers\Serializer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Filesystem\FilesystemAdapter;
use InvalidArgumentException;
use Throwable;

final class FlatFile implements FlatFileContract
{
    private FilesystemAdapter $storage;

    private Serializer|string $serializer;

    private Model|string $model;

    /**
     * @throws Throwable
     */
    public function getStorage(): FilesystemAdapter
    {
        return $this->storage;
    }

    public function setStorage(FilesystemAdapter $storage): self
    {
        $this->storage = $storage;

        return $this;
    }

    public function getSerializer(): Serializer|string
    {
        return $this->serializer;
    }

    public function setSerializer(Serializer|string $serializer): self
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        throw_if(
            is_subclass_of($serializer, Serializer::class) === false,
            InvalidArgumentException::class,
            sprintf('Expected "%s" got: %s', Serializer::class, gettype($serializer)),
        );

        $this->serializer = $serializer;

        return $this;
    }

    public function getModel(): Model|string
    {
        return $this->model;
    }

    public function setModel(Model|string $model): self
    {
        $this->model = $model;

        return $this;
    }

    /**
     * @throws Throwable
     */
    public function getPathResolver(): PathResolver
    {
        return PathResolver::make(
            $this->model,
            $this->getStorage()->path('.'),
            $this->getSerializer()::extension(),
        );
    }
}
