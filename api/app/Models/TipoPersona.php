<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoPersona extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $table = 'tipo_persona';
    protected $primaryKey = 'id_tipo_persona';
    protected $dates = ['deleted_at'];
    public $timestamps = true;
    protected $fillable = [
        'tipo_persona',
    ];
}
