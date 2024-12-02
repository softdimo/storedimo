<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $table = 'productos';
    protected $primaryKey = 'id_producto';
    protected $dates = ['deleted_at'];
    public $timestamps = true;
    protected $fillable = [
        'nombre_producto',
        'id_categoria',
        'precio_unitario',
        'precio_detal',
        'precio_por_mayor',
        'descripcion',
        'stock_minimo',
        'id_estado',
        'tamano',
        'cantidad',
    ];
}
