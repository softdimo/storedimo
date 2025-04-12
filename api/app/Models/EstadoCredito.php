<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use OwenIt\Auditing\Contracts\Auditable; // Interfaz
use OwenIt\Auditing\Auditable as AuditableTrait; // Trait

// class EstadoCredito extends Model
class EstadoCredito extends Model implements Auditable
{
    use SoftDeletes;
    use AuditableTrait;

    protected $connection = 'mysql';
    protected $table = 'estados_credito';
    protected $primaryKey = 'id_estado_credito';
    protected $dates = ['deleted_at'];
    public $timestamps = true;
    protected $fillable = [
        'estado_credito',
    ];
}
