<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoPago extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $table = 'tipos_pago';
    protected $primaryKey = 'id_tipo_pago';
    protected $dates = ['deleted_at'];
    public $timestamps = true;
    protected $fillable = [
        'tipo_pago',
    ];
}
