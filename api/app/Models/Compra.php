<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Compra extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $table = 'compras';
    protected $primaryKey = 'id_compra';
    protected $dates = ['deleted_at'];
    public $timestamps = true;
    protected $fillable = [
        'fecha_compra',
        'valor_compra',
        'id_proveedor',
        'id_usuario',
        'id_estado'
    ];
}
