<?php

namespace App\Http\Responsable\entradas;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use App\Models\Compra;

class EntradaUpdate implements Responsable
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function toResponse($request)
    {
        $id = $request->route('id');
        $categoria = Compra::find($id);

        if (isset($categoria) && !is_null($categoria) && !empty($categoria)) {
            $categoria->categoria = $this->request->input('categoria');
            $categoria->update();

            return response()->json([
                'success' => true,
                'message' => 'La categoría se actualizó correctamente'
            ]);
        } else {
            return abort(404, $message = 'No existe esta categoria');
        }
    }

    // ===================================================================
    // ===================================================================


}
