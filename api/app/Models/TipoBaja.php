<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use OwenIt\Auditing\Contracts\Auditable; // Interfaz
use OwenIt\Auditing\Auditable as AuditableTrait; // Trait

// class TipoBaja extends Model
class TipoBaja extends Model implements Auditable
{
    use SoftDeletes;
    use AuditableTrait;

    protected $connection = 'mysql';
    protected $table = 'tipo_baja';
    protected $primaryKey = 'id_tipo_baja';
    protected $dates = ['deleted_at'];
    public $timestamps = true;
    protected $fillable = [
        'tipo_baja',
    ];
}
