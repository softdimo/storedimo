<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prestamo extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $table = 'prestamos';
    protected $primaryKey = 'id_prestamo';
    protected $dates = ['deleted_at'];
    public $timestamps = true;
    protected $fillable = [
        'id_empresa',
        'id_estado_prestamo',
        'id_usuario',
        'valor_prestamo',
        'fecha_prestamo',
        'fecha_limite',
        'descripcion'
    ];
}
