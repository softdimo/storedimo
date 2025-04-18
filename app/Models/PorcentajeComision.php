<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PorcentajeComision extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $table = 'porcentajes_comision';
    protected $primaryKey = 'id_porcentaje_comision';
    protected $dates = ['deleted_at'];
    public $timestamps = true;
    protected $fillable = [
        'porcentaje_comision'
    ];
}
