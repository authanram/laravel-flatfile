<?php

namespace Authanram\FlatFile\Tests\TestFiles;

//use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Authanram\FlatFile\Concerns\FlatModel;

class FlatFileModel extends Model
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
