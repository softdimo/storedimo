<?php

namespace App\Http\Responsable\pago_empleados;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use App\Models\Venta;

class PrestamoUpdate implements Responsable
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function toResponse($request)
    {
        $id = $request->route('id');
        $categoria = Prestamo::find($id);

        try {
            if (isset($categoria) && !is_null($categoria) && !empty($categoria)) {
                $categoria->categoria = $this->request->input('categoria');
                $categoria->update();
    
                return response()->json(['success' => true]);
            }
        } catch (Exception $e) {
            return response()->json(['error_bd' => $e->getMessage()]);
        }
    }
}
