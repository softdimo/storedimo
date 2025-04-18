<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proveedor extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $table = 'proveedores';
    protected $primaryKey = 'id_proveedor';
    protected $dates = ['deleted_at'];
    public $timestamps = true;
    protected $fillable = [
        'id_empresa',
        'id_tipo_persona',
        'id_tipo_documento',
        'identificacion',
        'nombres_proveedor',
        'apellidos_proveedor',
        'telefono_proveedor',
        'celular_proveedor',
        'email_proveedor',
        'id_estado',
        'direccion_proveedor',
        'id_estado',
        'nit_proveedor',
        'proveedor_juridico',
        'telefono_juridico'
    ];
}
