<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompraProducto extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $table = 'compra_productos';
    protected $primaryKey = 'id_compra_producto';
    protected $dates = ['deleted_at'];
    public $timestamps = true;
    protected $fillable = [
        'id_compra',
        'id_producto',
        'cantidad',
        'precio_unitario_compra',
        'subtotal'
    ];
}
