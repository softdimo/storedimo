<?php

namespace App\Http\Responsable\entradas;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use App\Models\Compra;
use App\Helpers\DatabaseConnectionHelper;

class EntradaUpdate implements Responsable
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function toResponse($request)
    {
        // Obtener empresa_actual del request
        $empresaActual = $request->input('empresa_actual');

        // Configurar conexión tenant si hay empresa
        if ($empresaActual) {
            DatabaseConnectionHelper::configurarConexionTenant($empresaActual->toArray());
        }
        
        $id = $request->route('id');
        $categoria = Compra::find($id);

        if (isset($categoria) && !is_null($categoria) && !empty($categoria)) {
            $categoria->categoria = $this->request->input('categoria');
            $categoria->update();

            // Restaurar conexión principal si se usó tenant
            if ($empresaActual) {
                DatabaseConnectionHelper::restaurarConexionPrincipal();
            }

            return response()->json([
                'success' => true,
                'message' => 'La categoría se actualizó correctamente'
            ]);
        } else {
            // Asegurar restauración de conexión principal en caso de error
            if (isset($empresaActual)) {
                DatabaseConnectionHelper::restaurarConexionPrincipal();
            }
            
            return abort(404, $message = 'No existe esta categoria');
        }
    }

    // ===================================================================
    // ===================================================================


}
