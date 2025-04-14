<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use OwenIt\Auditing\Contracts\Auditable; // Interfaz
use OwenIt\Auditing\Auditable as AuditableTrait; // Trait

// class Baja extends Model
class Baja extends Model implements Auditable
{
    use SoftDeletes;
    use AuditableTrait;

    protected $connection = 'mysql';
    protected $table = 'bajas';
    protected $primaryKey = 'id_baja';
    protected $dates = ['deleted_at'];
    public $timestamps = true;
    protected $fillable = [
        'id_responsable_baja',
        'fecha_baja',
        'id_estado_baja'
    ];
}
