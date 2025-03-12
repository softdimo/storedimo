<?php

namespace App\Http\Responsable\pago_empleados;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\PagoEmpleado;

class PagoEmpleadoIndex implements Responsable
{
    public function toResponse($request)
    {
        try {
            $pagoEmpleados = PagoEmpleado::leftjoin('estados','estados.id_estado','=','pago_empleados.id_estado')
                ->leftjoin('usuarios','usuarios.id_usuario','=','pago_empleados.id_usuario')
                ->leftjoin('tipo_persona','tipo_persona.id_tipo_persona','=','usuarios.id_tipo_persona')
                ->leftjoin('tipo_documento','tipo_documento.id_tipo_documento','=','usuarios.id_tipo_documento')
                ->leftjoin('tipos_pago','tipos_pago.id_tipo_pago','=','pago_empleados.id_tipo_pago')
                ->leftjoin('periodos_pago','periodos_pago.id_periodo_pago','=','pago_empleados.id_periodo_pago')
                ->select(
                    'id_pago_empleado',
                    'tipos_pago.id_tipo_pago',
                    'tipo_pago',
                    'fecha_pago',
                    'usuarios.id_usuario',
                    DB::raw("CONCAT(nombre_usuario, ' ', apellido_usuario) AS nombres_usuario"),
                    'nombre_usuario',
                    'apellido_usuario',
                    'identificacion',
                    'tipo_persona.id_tipo_persona',
                    'tipo_persona',
                    'usuarios.id_tipo_documento',
                    'tipo_documento',
                    'valor_ventas',
                    'valor_comision',
                    'periodos_pago.id_periodo_pago',
                    'periodo_pago',
                    'cantidad_dias',
                    'valor_dia',
                    'valor_prima',
                    'valor_vacaciones',
                    'valor_cesantias',
                    'salario_neto',
                    'valor_total',
                    'estados.id_estado',
                    'estado'
                )
                ->orderByDesc('fecha_pago')
                ->get();

                return response()->json($pagoEmpleados);

        } catch (Exception $e) {
            return response()->json(['error_bd' => $e->getMessage()]);
        }
    }
}
