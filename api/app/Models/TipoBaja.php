<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoBaja extends Model
{
    use SoftDeletes;

    protected $connection = 'pgsql';
    protected $table = 'tipo_baja';
    protected $primaryKey = 'id_tipo_baja';
    protected $dates = ['deleted_at'];
    public $timestamps = true;
    protected $fillable = [
        'tipo_baja',
    ];
}
