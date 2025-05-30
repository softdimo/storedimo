<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use OwenIt\Auditing\Contracts\Auditable; // Interfaz
use OwenIt\Auditing\Auditable as AuditableTrait; // Trait

// class Persona extends Model
class Persona extends Model implements Auditable
{
    use SoftDeletes;
    use AuditableTrait;

    protected $connection = 'mysql';
    protected $table = 'personas';
    protected $primaryKey = 'id_persona';
    protected $dates = ['deleted_at'];
    public $timestamps = true;
    protected $fillable = [
        'id_empresa',
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
        'nit_empresa',
        'nombre_empresa',
        'telefono_empresa'
    ];
}
