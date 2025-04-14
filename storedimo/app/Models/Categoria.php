<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $table = 'categorias';
    protected $primaryKey = 'id_categoria';
    protected $dates = ['deleted_at'];
    public $timestamps = true;
    protected $fillable = [
        'categoria',
        'id_estado',
    ];
}
