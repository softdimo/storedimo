<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Venta extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $table = 'ventas';
    protected $primaryKey = 'id_venta';
    protected $dates = ['deleted_at'];
    public $timestamps = true;
    protected $fillable = [
        'id_empresa',
        'fecha_venta',
        'descuento',
        'subtotal_venta',
        'total_venta',
        'id_tipo_pago',
        'id_producto',
        'id_cliente',
        'id_usuario',
        'id_estado',
        'id_estado_credito',
        'fecha_limite_credito'
    ];
}
