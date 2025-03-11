<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PeriodoPago extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $table = 'periodos_pago';
    protected $primaryKey = 'id_periodo_pago';
    protected $dates = ['deleted_at'];
    public $timestamps = true;
    protected $fillable = [
        'periodo_pago'
    ];
}
