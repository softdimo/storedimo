<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EstadoCredito extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $table = 'estados_credito';
    protected $primaryKey = 'id_estado_credito';
    protected $dates = ['deleted_at'];
    public $timestamps = true;
    protected $fillable = [
        'estado_credito',
    ];
}
