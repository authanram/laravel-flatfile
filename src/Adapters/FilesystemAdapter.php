<?php

namespace Authanram\FlatFile\Adapters;

use Authanram\FlatFile\Serializers\Serializer;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Authanram\FlatFile\Contracts\FlatFileAdapterContract;
use Illuminate\Support\Str;
use InvalidArgumentException;

final class FilesystemAdapter implements FlatFileAdapterContract
{
    private Filesystem $storage;

    public function __construct(array $config, private Serializer|string $serializer)
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        throw_if(
            is_subclass_of($serializer, Serializer::class) === false,
            InvalidArgumentException::class,
            sprintf('Expected "%s" got: %s', Serializer::class, gettype($serializer)),
        );

        $this->storage = Storage::build($config);
    }

    public function locate(Model|string $model): string
    {
        $className = is_string($model) ? $model : $model::class;

        $path = Str::kebab(class_basename($className));

        if (is_object($model) && is_null($model->getKey()) === false) {
            $path = Str::of($path)
                ->append('/')
                ->append($model->getKey())
                ->append($this->serializer::extension())
                ->toString();
        }

        return $this->storage->path($path);
    }

    public function get(Model|string $model): array
    {
        return collect($this->storage->files($this->getRelativeStoragePath($model)))
            ->map(fn (string $path) => $this->serializer::decode($this->storage->get($path)))
            ->toArray();
    }

    public function set(Model $model): bool
    {
        $path = $this->getRelativeStoragePath($model);

        return $model->exists
            ? $this->storage->put($path, $this->serializer::encode($model->getAttributes()))
            : $this->storage->delete($path);
    }

    private function getRelativeStoragePath(Model|string $model): string
    {
        return str_replace($this->storage->path(''), '', $this->locate($model));
    }
}
