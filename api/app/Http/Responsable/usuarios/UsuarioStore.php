<?php

namespace App\Http\Responsable\categorias;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Categoria;

class CategoriaStore implements Responsable
{
    public function toResponse($request)
    {
        $categoria = request('categoria', null);

        // ================================================

        $nuevaCategoria = Categoria::create([
            'categoria' => $categoria,
        ]);

        // ================================================

        if (isset($nuevaCategoria) && !is_null($nuevaCategoria) && !empty($nuevaCategoria)) {
            return response()->json([
                'success' => true,
                'message' => 'Categoría creada correctamente'
            ]);
        } else {
            return abort(404, $message = 'Categoría no creada');
        }
    }

    // ===================================================================
    // ===================================================================


}
