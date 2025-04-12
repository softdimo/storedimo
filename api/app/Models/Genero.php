<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use OwenIt\Auditing\Contracts\Auditable; // Interfaz
use OwenIt\Auditing\Auditable as AuditableTrait; // Trait

// class Genero extends Model
class Genero extends Model implements Auditable
{
    use SoftDeletes;
    use AuditableTrait;

    protected $connection = 'mysql';
    protected $table = 'generos';
    protected $primaryKey = 'id_genero';
    protected $dates = ['deleted_at'];
    public $timestamps = true;
    protected $fillable = [
        'genero',
    ];
}
