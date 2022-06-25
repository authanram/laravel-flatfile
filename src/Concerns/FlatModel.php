<?php

namespace Authanram\FlatFile\Concerns;

use Authanram\FlatFile\Contracts\FlatFileAdapterContract;
use Authanram\FlatFile\Contracts\FlatFileContract;
use Authanram\FlatFile\Serializers\Serializer;
use Sushi\Sushi;

trait FlatModel
{
    use Sushi;

    public static FlatFileAdapterContract $flatFileAdapter;

    public static Serializer|string $flatFileSerializer;

    public static function bootFlatModel(): void
    {
        $flatFile = resolve(FlatFileContract::class);

        $eventHandlers = $flatFile->getEventHandlers();

        $setup = static function ($model) use ($flatFile) {
            $model::$flatFileAdapter ??= $flatFile->getAdapter();
            $model::$flatFileSerializer ??= $flatFile->getSerializer();
            return $model;
        };

        foreach ($eventHandlers as $name => $handler) {
            static::{$name}(static fn (self $model) => $handler($setup($model)));
        }
    }

    public function getRows(): array
    {
        return [
            ['foo' => 'bar'],
        ];
    }
}
