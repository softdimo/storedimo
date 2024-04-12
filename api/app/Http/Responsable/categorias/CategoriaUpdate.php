<?php

namespace App\Http\Responsable\categorias;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaUpdate implements Responsable
{
    public function toResponse($request, $id)
    {
        dd($request, $id);
        
        // $idCategoria = request('id_categoria', null);
        // dd($idCategoria);

        $categoria = Categoria::find($id);

        if (isset($categoria) && !is_null($categoria) && !empty($categoria)) {
            $categoria->categoria = $request->input('categoria');
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
