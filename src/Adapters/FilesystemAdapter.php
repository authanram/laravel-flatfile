<?php

namespace Authanram\FlatFile\Adapters;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Authanram\FlatFile\Contracts\FlatFileAdapterContract;

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
        return '';
    }

    public function get(Model|string $model): array
    {
        return $this->storage::files(
            $this->locate(is_string($model) ? $model : $model::class),
        );
    }

    public function set(Model $model): self
    {
        return $this;
    }
}
