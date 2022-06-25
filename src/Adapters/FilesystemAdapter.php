<?php

namespace Authanram\FlatFile\Adapters;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Authanram\FlatFile\Contracts\FlatFileAdapterContract;
use Illuminate\Support\Str;

final class FilesystemAdapter implements FlatFileAdapterContract
{
    private Filesystem $storage;

    public static function build(array $config): self
    {
        return new self($config);
    }

    private function __construct(array $config)
    {
        $this->storage = Storage::build($config);
    }

    public function locate(Model|string $model): string
    {
        $className = is_string($model) ? $model : $model::class;

        $path = Str::of(class_basename($className))->kebab();

        if (is_object($model)) {
            $path->append('/'.$model->getKey());
        }

        return $this->storage->path($path->toString());
    }

    public function get(Model|string $model): array
    {
        return $this->storage::files(
            $this->locate(is_string($model) ? $model : $model::class),
        );
    }

    public function set(Model $model): self
    {
        //dump($model::$flatFileAdapter);

        return $this;
    }
}
