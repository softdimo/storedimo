<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Usuario extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    protected $dates = ['deleted_at'];
    public $timestamps = true;
    protected $fillable = [
        'id_usuario',
        'id_tipo_persona',
        'numero_telefono',
        'celular',
        'id_genero',
        'direccion',
        'fecha_contrato',
        'fecha_terminacion_contrato',
        'nombre_usuario',
        'apellido_usuario',
        'usuario',
        'id_tipo_documento',
        'identificacion',
        'email',
        'clave',
        'clave_fallas',
        'id_estado',
        'id_rol',
    ];
}
