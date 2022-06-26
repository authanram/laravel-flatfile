<?php

namespace Authanram\FlatFile\Tests\TestFiles;

use Illuminate\Database\Eloquent\SoftDeletes;

class SoftDeletesModel extends FlatFileModel
{
    use SoftDeletes;
}
