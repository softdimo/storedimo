<?php

namespace App\Http\Controllers\unidades_medida;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Http\Responsable\unidades_medida\UnidadMedidaIndex;
use App\Http\Responsable\unidades_medida\UnidadMedidaStore;
use App\Http\Responsable\unidades_medida\UnidadMedidaEdit;
use App\Http\Responsable\unidades_medida\UnidadMedidaUpdate;
use App\Http\Responsable\unidades_medida\UnidadMedidaDestroy;
use App\Models\UnidadMedida;
use App\Helpers\DatabaseConnectionHelper;
use App\Models\Empresa;

class UnidadesMedidaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new UnidadMedidaIndex();
    }

    // ======================================================================
    // ======================================================================

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    // ======================================================================
    // ======================================================================

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return new UnidadMedidaStore();
    }

    // ======================================================================
    // ======================================================================

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        //
    }

    // ======================================================================
    // ======================================================================

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($idUmd)
    {
        // return new UnidadMedidaEdit($idUmd);
    }

    // ======================================================================
    // =====================================================================c=

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idUmd)
    {
        // return new UnidadMedidaUpdate($request, $idUmd);
    }

    // ======================================================================
    // ======================================================================

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idUmd)
    {
        // return new UnidadMedidaDestroy($idUmd);
    }
    
    // ======================================================================
    // ======================================================================

    // public function umdTrait(Request $request)
    // {
    //     // 1. Obtener ID de empresa del request (antes era empresa_actual completo)
    //     $empresaId = $request->input('empresa_actual');

    //     // 2. Buscar empresa completa usando el ID
    //     $empresaActual = Empresa::find($empresaId);
        
    //     // Configurar conexión tenant si hay empresa
    //     if ($empresaActual)
    //     {
    //         DatabaseConnectionHelper::configurarConexionTenant($empresaActual->toArray());
    //     }
        
    //     try
    //     {
    //         $umd = UnidadMedida::select(DB::raw("CONCAT(descripcion, ' (', abreviatura, ')') AS umd"), 'id')
    //                             ->where('estado_id', 1)
    //                             ->orderBy('id')
    //                             ->pluck('umd', 'id');

    //         // Retornamos la categoría si existe, de lo contrario retornamos null
    //         if (isset($umd) && !is_null($umd) && !empty($umd))
    //         {
    //             // Restaurar conexión principal si se usó tenant
    //             if ($empresaActual) {
    //                 DatabaseConnectionHelper::restaurarConexionPrincipal();
    //             }

    //             return response()->json($umd);
                
    //         } else
    //         {
    //             return response(null, 200);
    //         }

    //     } catch (Exception $e) {
    //         // Asegurar restauración de conexión principal en caso de error
    //         if (isset($empresaActual))
    //         {
    //             DatabaseConnectionHelper::restaurarConexionPrincipal();
    //         }
            
    //         return response()->json(['error_bd' => $e->getMessage()]);
    //     }
    // }
}
