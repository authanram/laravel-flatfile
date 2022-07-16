<?php

declare(strict_types=1);

namespace Authanram\FlatFile;

use Authanram\FlatFile\Serializers\Serializer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Filesystem\FilesystemAdapter;
use Throwable;

interface FlatFileContract
{
    /**
     * @throws Throwable
     */
    public function setSerializer(Serializer|string $serializer): self;

    public function setStorage(FilesystemAdapter $storage): self;

    /**
     * @return array<int, string>
     *
     * @throws Throwable
     *
     * @noinspection PhpDocSignatureIsNotCompleteInspection
     */
    public function all(Model $model): array;

    /**
     * @throws Throwable
     */
    public function save(Model $model): bool;

    /**
     * @throws Throwable
     */
    public function delete(Model $model): bool;
}
