<?php

declare(strict_types=1);

namespace Authanram\FlatFile;

use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;
use Throwable;

/**
 * @property $this $flatFileSerializer
 */
trait FlatFileModel
{
    use Sushi;

    /**
     * @throws Throwable
     */
    public static function bootFlatFileModel(): void
    {
        static::saved(static fn (Model $model) => Actions::saved(self::flatFile($model)));
        static::deleted(static fn (Model $model) => Actions::deleted(self::flatFile($model)));
    }

    /**
     * @throws Throwable
     */
    public function getRows(): array
    {
        return Actions::all(self::flatFile(static::class));
    }

    public function usesTimestamps(): bool
    {
        return $this->timestamps ?? false;
    }

    /**
     * @throws Throwable
     */
    private static function flatFile(Model|string $model): FlatFileContract
    {
        return resolve(FlatFileContract::class)
            ->setSerializer(static::$flatFileSerializer ?? config('flatfile.serializer'))
            ->setModel($model);
    }
}
