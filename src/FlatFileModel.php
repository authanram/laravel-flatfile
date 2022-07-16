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
     *
     * @noinspection PhpUnused
     */
    public static function bootFlatFileModel(): void
    {
        static::saved(static fn(Model $model) => self::flatFile()->save($model));
        static::deleted(static fn(Model $model) => self::flatFile()->delete($model));
    }

    /**
     * @return array<int, array<mixed>>
     *
     * @throws Throwable
     */
    public function getRows(): array
    {
        return self::flatFile()->all($this);
    }

    public function usesTimestamps(): bool
    {
        return $this->timestamps ?? false;
    }

    /**
     * @throws Throwable
     */
    private static function flatFile(): FlatFileContract
    {
        return resolve(FlatFileContract::class)
            ->setSerializer(static::$flatFileSerializer ?? config('flatfile.serializer'));
    }
}
