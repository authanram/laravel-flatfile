<?php

namespace Authanram\FlatFile\Concerns;

use Sushi\Sushi;

trait FlatModel
{
    use Sushi;

    public static function bootFlatModel(): void
    {
    }

    public function getRows(): array
    {
        return [
            ['foo' => 'bar'],
        ];
    }
}
