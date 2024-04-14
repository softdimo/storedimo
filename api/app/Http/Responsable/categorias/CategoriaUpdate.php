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
    protected $request;
    protected $id;

    public function __construct(Request $request, $id)
    {
        $this->request = $request;
        $this->id = $id;
    }

    public function toResponse($request)
    {
        $categoria = Categoria::find($this->id);

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
