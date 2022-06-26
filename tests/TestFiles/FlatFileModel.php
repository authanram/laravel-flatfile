<?php

namespace Authanram\FlatFile\Tests\TestFiles;

//use Illuminate\Database\Eloquent\SoftDeletes;
use Eloquent;

class FlatFileModel extends Eloquent
{
    use \Authanram\FlatFile\FlatFileModel;
//    use SoftDeletes;

    public $timestamps = true;

    protected array $schema = [
        'name' => 'string',
        'data' => 'json',
    ];

    protected $fillable = [
        'name',
        'data',
    ];

    protected $casts = [
        'data' => 'array',
    ];
}
