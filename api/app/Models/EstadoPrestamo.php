<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use OwenIt\Auditing\Contracts\Auditable; // Interfaz
use OwenIt\Auditing\Auditable as AuditableTrait; // Trait

// class EstadoPrestamo extends Model
class EstadoPrestamo extends Model implements Auditable
{
    use SoftDeletes;
    use AuditableTrait;

    protected $connection = 'mysql';
    protected $table = 'estados_prestamo';
    protected $primaryKey = 'id_estado_prestamo';
    protected $dates = ['deleted_at'];
    public $timestamps = true;
    protected $fillable = [
        'estado_prestamo'
    ];
}
