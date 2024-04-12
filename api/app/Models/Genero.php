<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Genero extends Model
{
    use SoftDeletes;

    protected $connection = 'pgsql';
    protected $table = 'generos';
    protected $primaryKey = 'id_genero';
    protected $dates = ['deleted_at'];
    public $timestamps = true;
    protected $fillable = [
        'genero',
    ];
}
