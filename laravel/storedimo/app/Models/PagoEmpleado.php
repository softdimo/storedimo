<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PagoEmpleado extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $table = 'pago_empleados';
    protected $primaryKey = 'id_pago_empleado';
    protected $dates = ['deleted_at'];
    public $timestamps = true;
    protected $fillable = [
        'id_tipo_pago',
        'fecha_pago',
        'id_usuario',
        'valor_ventas',
        'valor_comision',
        'cantidad_dias',
        'valor_dia',
        'valor_prima',
        'valor_vacaciones',
        'valor_cesantias',
        'valor_total',
        'id_estado'
    ];
}
