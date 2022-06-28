<?php

declare(strict_types=1);

namespace Authanram\FlatFile;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

final class PathResolver
{
    public static function make(Model|string $model, string $path, string $extension): self
    {
        $isObject = is_object($model);

        $classname = $isObject ? $model::class : $model;

        $relative = Str::kebab(class_basename($classname));

        $filename = $isObject ? $model->getKey().$extension : '';

        return new self(realpath($path), $relative, $filename);
    }

    private function __construct(
        private string $absolute,
        private string $relative,
        private string $filename
    ) {}

    public function getAbsolutePath(): string
    {
        return $this->absolute.'/'.$this->relative;
    }

    public function getRelativePath(): string
    {
        return $this->relative;
    }

    public function getAbsolutePathname(): string
    {
        return rtrim($this->absolute.'/'.$this->relative.'/'.$this->filename, '/');
    }

    public function getRelativePathname(): string
    {
        return $this->relative.'/'.$this->filename;
    }

    public function getFilename(): string
    {
        return $this->filename;
    }

    public function __toString(): string
    {
        return $this->getAbsolutePathname();
    }
}
