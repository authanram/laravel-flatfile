<?php

declare(strict_types=1);

namespace Authanram\FlatFile\Adapters;

use Authanram\FlatFile\Contracts\FlatFileAdapterContract;
use Authanram\FlatFile\Serializers\Serializer;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use InvalidArgumentException;

final class FilesystemAdapter implements FlatFileAdapterContract
{
    private Filesystem $storage;

    private Serializer|string $serializer;

    public function __construct(array $config, Serializer|string $serializer)
    {
        $this->setSerializer($serializer);

        $this->storage = Storage::build($config);
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

    public function locate(Model|string $model): string
    {
        $this->setSerializer($model::{'flatFileSerializer'}() ?? $this->serializer);

        $className = is_string($model) ? $model : $model::class;

        $path = Str::kebab(class_basename($className));

        if (is_object($model) && $model->getKey()) {
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
        $this->setSerializer($model::{'flatFileSerializer'}() ?? $this->serializer);

        return collect($this->storage->files($this->getStoragePath($model)))
            ->map(fn (string $path) => $this->serializer::decode($this->storage->get($path)))
            ->toArray();
    }

    public function set(Model $model): bool
    {
        $this->setSerializer($model::{'flatFileSerializer'}() ?? $this->serializer);

        $path = $this->getStoragePath($model);

        if ($model->exists) {
            return $this->storage->put($path, $this->serializer::encode($model->getAttributes()));
        }

        $result = $this->storage->delete($path);

        $directory = dirname($path);

        if ($result && count($this->storage->files($directory)) === 0) {
            $result = $this->storage->deleteDirectory($directory);
        }

        return $result;
    }

    private function getStoragePath(Model|string $model): string
    {
        return str_replace($this->storage->path(''), '', $this->locate($model));
    }
}
