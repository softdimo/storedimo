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
        'nombre_usuario',
        'apellido_usuario',
        'usuario',
        'identificacion',
        'email',
        'clave',
        'id_estado',
        'id_rol',
    ];
}
