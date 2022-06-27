<?php

declare(strict_types=1);

namespace Authanram\FlatFile;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

final class PathResolver
{
    public static function make(Model|string $model, string $path, string $extension): self
    {
        return new self(
            realpath($path),
            Str::of(class_basename(is_string($model) ? $model : $model::class))
                ->kebab()
                ->append(is_object($model) ? '/'.$model->getKey().$extension : '')
                ->toString()
        );
    }

    private function __construct(private string $absolute, private string $relative)
    {
    }

    public function getAbsolute(): string
    {
        return $this->absolute;
    }

    public function getRelative(): string
    {
        return $this->relative;
    }

    public function __toString(): string
    {
        return $this->absolute.'/'.$this->relative;
    }
}
