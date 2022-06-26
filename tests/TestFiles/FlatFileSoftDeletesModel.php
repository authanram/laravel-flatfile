<?php

namespace Authanram\FlatFile\Tests\TestFiles;

use Illuminate\Database\Eloquent\SoftDeletes;

class FlatFileSoftDeletesModel extends FlatFileModel
{
    use SoftDeletes;
}
