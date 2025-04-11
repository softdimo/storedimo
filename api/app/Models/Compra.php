<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use OwenIt\Auditing\Contracts\Auditable; // Interfaz
use OwenIt\Auditing\Auditable as AuditableTrait; // Trait

// class Compra extends Model
class Compra extends Model implements Auditable
{
    use SoftDeletes;
    use AuditableTrait;

    protected $connection = 'mysql';
    protected $table = 'compras';
    protected $primaryKey = 'id_compra';
    protected $dates = ['deleted_at'];
    public $timestamps = true;
    protected $fillable = [
        'id_empresa',
        'fecha_compra',
        'valor_compra',
        'id_proveedor',
        'id_producto',
        'id_usuario',
        'id_estado'
    ];
}
