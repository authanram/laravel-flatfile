<?php

declare(strict_types=1);

namespace Authanram\FlatFile\Contracts;

use Authanram\FlatFile\PathResolver;
use Authanram\FlatFile\Serializers\Serializer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Filesystem\FilesystemAdapter;

interface FlatFileContract
{
    public function getStorage(): FilesystemAdapter;

    public function setStorage(FilesystemAdapter $storage): self;

    public function getSerializer(): Serializer|string;

    public function setSerializer(Serializer|string $serializer): self;

    public function getModel(): Model|string;

    public function setModel(Model|string $model): self;

    public function getPathResolver(): PathResolver;
}
