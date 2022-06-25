<?php

namespace Authanram\FlatFile\Concerns;

use Authanram\FlatFile\Contracts\FlatFileAdapterContract;
use Authanram\FlatFile\Contracts\FlatFileContract;
use Authanram\FlatFile\Serializers\Serializer;
use Illuminate\Database\Eloquent\Model;
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

        foreach ($eventHandlers as $name => $handler) {
            static::{$name}(static function (Model $model) use ($flatFile, $handler) {
                $model::$flatFileAdapter ??= $flatFile->getAdapter();
                $model::$flatFileSerializer ??= $flatFile->getSerializer();
                $handler($model);
            });
        }
    }

    public function getRows(): array
    {
        return [
            ['foo' => 'bar'],
        ];
    }
}
