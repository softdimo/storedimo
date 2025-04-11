<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use OwenIt\Auditing\Contracts\Auditable; // Interfaz
use OwenIt\Auditing\Auditable as AuditableTrait; // Trait

// class VentaProducto extends Model
class VentaProducto extends Model implements Auditable
{
    use SoftDeletes;
    use AuditableTrait;

    protected $connection = 'mysql';
    protected $table = 'venta_productos';
    protected $primaryKey = 'id_venta_producto';
    protected $dates = ['deleted_at'];
    public $timestamps = true;
    protected $fillable = [
        'id_venta',
        'id_producto',
        'cantidad',
        'precio_detal_venta',
        'precio_x_mayor_venta',
        'subtotal'
    ];
}
