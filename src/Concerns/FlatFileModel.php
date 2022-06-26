<?php

namespace Authanram\FlatFile\Concerns;

use Authanram\FlatFile\Contracts\FlatFileContract;
use Authanram\FlatFile\FlatFile;
use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;
use Throwable;

trait FlatFileModel
{
    use Sushi;

    private static FlatFileContract $flatFile;

    /**
     * @throws Throwable
     */
    public static function bootFlatFileModel(): void
    {
        collect(self::flatFile()->getEventHandlers())
            ->each(function (callable $handler, string $name) {
                static::{$name}(static fn (Model $model) => $handler($model));
            });
    }

    /**
     * @throws Throwable
     */
    public static function flatFile(): FlatFileContract
    {
        return self::$flatFile ?? (new FlatFile())
            ->setStorageAdapter(config('flatfile.storage_adapter'))
            ->setEventHandlers(config('flatfile.event_handlers'));
    }

    /**
     * @throws Throwable
     */
    public function getRows(): array
    {
        return self::flatFile()
            ->getStorageAdapter()
            ->get($this::class);
    }

    public function usesTimestamps(): bool
    {
        return $this->timestamps;
    }
}
