<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empresa extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $table = 'empresas';
    protected $primaryKey = 'id_empresa';
    protected $dates = ['deleted_at'];
    public $timestamps = true;
    protected $fillable = [
        'nit_empresa',
        'nombre_empresa',
        'telefono_empresa',
        'celular_empresa',
        'email_empresa',
        'direccion_empresa',
        'app_key', // app key
        'app_url', // app url
        'id_tipo_bd', // db connection
        'db_database', // db database
        'db_username', // db username
        'db_password', // db password
        'id_estado' // estado
    ];
}
