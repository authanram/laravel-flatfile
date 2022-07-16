<?php

declare(strict_types=1);

namespace Authanram\FlatFile;

final class PathResolver
{
    private function __construct(
        private readonly string $absolute,
        private readonly string $relative,
        private readonly string $filename
    ) {
    }

    public function __toString(): string
    {
        return $this->getAbsolutePathname();
    }

    public static function make(string $directory, string $basename, string $extension): self
    {
        $path = realpath(config('flatfile.disk.root'));

        $relative = $directory;

        $filename = $basename !== '' ? $basename.$extension : '';

        return new self($path, $relative, $filename);
    }

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
}
