<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use OwenIt\Auditing\Contracts\Auditable; // Interfaz
use OwenIt\Auditing\Auditable as AuditableTrait; // Trait

// class TipoDocumento extends Model
class TipoDocumento extends Model implements Auditable
{
    use SoftDeletes;
    use AuditableTrait;

    protected $connection = 'mysql';
    protected $table = 'tipo_documento';
    protected $primaryKey = 'id_tipo_documento';
    protected $dates = ['deleted_at'];
    public $timestamps = true;
    protected $fillable = [
        'tipo_documento',
    ];
}
