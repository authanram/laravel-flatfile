<?php

namespace Authanram\FlatFile\Tests\TestFiles;

//use Illuminate\Database\Eloquent\SoftDeletes;
use Authanram\FlatFile\Concerns\FlatModel;
use Eloquent;

class FlatFileModel extends Eloquent
{
    use FlatModel;
//    use SoftDeletes;

    public $timestamps = true;

    protected array $schema = [
        'name' => 'string',
        'data' => 'string',
    ];

    protected $fillable = [
        'name',
        'data',
    ];

    protected $casts = [
        'data' => 'array',
    ];
}
