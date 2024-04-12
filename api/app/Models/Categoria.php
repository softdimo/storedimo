<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    use SoftDeletes;

    protected $connection = 'pgsql';
    protected $table = 'categorias';
    protected $primaryKey = 'id_categoria';
    protected $dates = ['deleted_at'];
    public $timestamps = true;
    protected $fillable = [
        'categoria',
    ];
}
