<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use App\Models\Categoria;
use App\Models\Rol;
use App\Models\Estado;
use App\Models\TipoDocumento;
use App\Models\TipoPersona;
use App\Models\Genero;
use App\Models\Producto;
use App\Models\TipoBaja;
use App\Models\Persona;
use App\Models\TipoPago;
use App\Models\PeriodoPago;
use App\Models\PorcentajeComision;
use App\Models\Empresa;

trait MetodosTrait
{
    public function checkDatabaseConnection()
    {
        try {
            DB::connection()->getPdo();
            return true; // Conexión exitosa
        } catch (\Exception $e) {
            return false; // Conexión fallida
        }
    }

    // ======================================

    public function validarVariablesSesion()
    {
        $variablesSesion =[];

        $idUsuario = session('id_usuario');
        array_push($variablesSesion, $idUsuario);

        $usuario = session('usuario');
        array_push($variablesSesion, $usuario);

        $rolUsuario = session('id_rol');
        array_push($variablesSesion, $rolUsuario);

        $sesionIniciada = session('sesion_iniciada');
        array_push($variablesSesion, $sesionIniciada);

        return $variablesSesion;
    }

    // ======================================

    public function quitarCaracteresEspeciales($cadena)
    {
        $no_permitidas = array("á", "é", "í", "ó", "ú", "Á", "É", "Í", "Ó", "Ú", "ñ",
        "À", "Ã", "Ì", "Ò", "Ù", "Ã™", "Ã ","Ã¨", "Ã¬", "Ã²", "Ã¹", "ç", "Ç", "Ã¢",
        "ê", "Ã®", "Ã´", "Ã»", "Ã‚", "ÃŠ", "ÃŽ", "Ã”","Ã›", "ü", "Ã¶", "Ã–", "Ã¯",
        "Ã¤", "«", "Ò", "Ã", "Ã„", "Ã‹", "ñ", "Ñ", "*");

        $permitidas = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "n", "N", "A", "E", "I", "O", "U",
                            "a", "e", "i", "o", "u", "c", "C", "a", "e", "i", "o", "u", "A", "E", "I", "O", "U",
                            "u", "o", "O", "i", "a", "e", "U", "I", "A", "E", "n", "N", "");
        return str_replace($no_permitidas, $permitidas, $cadena);
    }

    // ======================================

    public function shareData()
    {
        view()->share('categorias', Categoria::orderBy('categoria')->pluck('categoria', 'id_categoria'));
        view()->share('roles', Rol::orderBy('rol')->pluck('rol', 'id_rol'));
        view()->share('estados', Estado::orderBy('estado')->pluck('estado', 'id_estado'));
        view()->share('tipos_documento', TipoDocumento::orderBy('tipo_documento')->pluck('tipo_documento', 'id_tipo_documento'));
        view()->share('tipos_empleado', TipoPersona::whereIn('id_tipo_persona', [1,2])->orderBy('tipo_persona')->pluck('tipo_persona', 'id_tipo_persona'));
        view()->share('tipos_persona', TipoPersona::whereNotIn('id_tipo_persona', [1,2])->orderBy('tipo_persona')->pluck('tipo_persona', 'id_tipo_persona'));
        view()->share('tipos_proveedor', TipoPersona::whereIn('id_tipo_persona', [3,4])->orderBy('tipo_persona')->pluck('tipo_persona', 'id_tipo_persona'));
        view()->share('clientes', TipoPersona::whereIn('id_tipo_persona', [5,6])->orderBy('tipo_persona')->pluck('tipo_persona', 'id_tipo_persona'));
        view()->share('generos', Genero::orderBy('genero')->pluck('genero', 'id_genero'));
        view()->share('tipos_baja', TipoBaja::orderBy('tipo_baja','asc')->pluck('tipo_baja', 'id_tipo_baja'));
        view()->share('productos', Producto::orderBy('nombre_producto')->pluck('nombre_producto', 'id_producto'));
        view()->share('tipos_pago_ventas', TipoPago::whereNotIn('id_tipo_pago', [4,5])->orderBy('tipo_pago')->pluck('tipo_pago', 'id_tipo_pago'));
        view()->share('tipos_pago_nomina', TipoPago::whereIn('id_tipo_pago', [4,5])->orderBy('tipo_pago')->pluck('tipo_pago', 'id_tipo_pago'));
        view()->share('periodos_pago', PeriodoPago::orderBy('periodo_pago')->pluck('periodo_pago', 'id_periodo_pago'));
        view()->share('porcentajes_comision', PorcentajeComision::orderBy('porcentaje_comision')->pluck('porcentaje_comision', 'id_porcentaje_comision'));
        view()->share('empresas', Empresa::orderBy('nombre_empresa')->pluck('nombre_empresa', 'id_empresa'));

        view()->share('proveedores', Persona::whereIn('id_tipo_persona', [3, 4])
            ->selectRaw("id_persona,
                CASE
                    WHEN nombre_empresa IS NOT NULL THEN nombre_empresa
                    ELSE CONCAT(nombres_persona, ' ', apellidos_persona)
                END AS nombre"
            )
            ->orderBy('nombre')
            ->pluck('nombre', 'id_persona')
        );

        view()->share([
            'clientes_ventas' => Persona::leftJoin('tipo_persona', 'tipo_persona.id_tipo_persona', '=', 'personas.id_tipo_persona')
                ->select(
                    'personas.id_persona', // Ahora usamos id_persona como clave
                    'personas.identificacion',
                    'personas.id_tipo_persona',
                    DB::raw("CONCAT(nombres_persona, ' ', apellidos_persona, ' (', tipo_persona, ')',' - ', identificacion) AS nombres_cliente")
                )
                ->whereIn('personas.id_tipo_persona', [5,6])
                ->orderBy('nombres_cliente')
                ->get() // Usamos get() en lugar de pluck()
                ->mapWithKeys(function($cliente) {
                    return [$cliente->id_persona => [
                        'nombre' => $cliente->nombres_cliente, // Lo que se mostrará en el select
                        'tipo' => $cliente->id_tipo_persona // id_tipo_persona Necesario para activar el checkbox
                    ]];
                }),
        ]);

        view()->share([
            'proveedores_compras' => Persona::leftJoin('tipo_persona', 'tipo_persona.id_tipo_persona', '=', 'personas.id_tipo_persona')
                ->select(
                    'personas.id_persona',
                    'personas.identificacion',
                    'personas.nit_empresa',
                    'personas.id_tipo_persona',
                    DB::raw("
                        CASE
                            WHEN personas.id_tipo_persona = 4 THEN CONCAT(nit_empresa, ' - ', nombre_empresa, ' (', tipo_persona.tipo_persona, ')')
                            ELSE CONCAT(identificacion, ' - ', nombres_persona, ' ', apellidos_persona, ' (', tipo_persona.tipo_persona, ')')
                        END AS nombre_proveedor
                    ")
                )
                ->whereIn('personas.id_tipo_persona', [3,4])
                ->orderBy('tipo_persona.tipo_persona')
                ->get() // Usamos get() en lugar de pluck()
                ->mapWithKeys(function($item) {
                    return [$item->id_persona => $item->nombre_proveedor]; // Usamos id_persona como clave única
                })
        ]);
    }
}
