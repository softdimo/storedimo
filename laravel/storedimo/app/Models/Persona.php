<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Persona extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $table = 'personas';
    protected $primaryKey = 'id_persona';
    protected $dates = ['deleted_at'];
    public $timestamps = true;
    protected $fillable = [
        'id_tipo_persona',
        'id_tipo_documento',
        'identificacion',
        'nombres_persona',
        'apellidos_persona',
        'numero_telefono',
        'celular',
        'email',
        'id_genero',
        'direccion',
        'id_estado',
        'fecha_contrato',
        'fecha_terminacion_contrato'
    ];
}
