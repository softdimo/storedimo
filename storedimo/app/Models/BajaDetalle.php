<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BajaDetalle extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $table = 'bajas_detalle';
    protected $primaryKey = 'id_baja_detalle';
    protected $dates = ['deleted_at'];
    public $timestamps = true;
    protected $fillable = [
        'id_baja',
        'id_tipo_baja',
        'id_producto',
        'cantidad',
        'observaciones'
    ];
}
