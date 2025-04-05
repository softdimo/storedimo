<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EstadoPrestamo extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $table = 'estados_prestamo';
    protected $primaryKey = 'id_estado_prestamo';
    protected $dates = ['deleted_at'];
    public $timestamps = true;
    protected $fillable = [
        'estado_prestamo'
    ];
}
