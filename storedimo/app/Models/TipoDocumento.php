<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoDocumento extends Model
{
    use SoftDeletes;

    protected $connection = 'mysql';
    protected $table = 'tipo_documento';
    protected $primaryKey = 'id_tipo_documento';
    protected $dates = ['deleted_at'];
    public $timestamps = true;
    protected $fillable = [
        'tipo_documento',
    ];
}
