<?php

namespace App\Http\Responsable\categorias;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Categoria;

class CategoriaEdit implements Responsable
{
    protected $idCategoria;

    // =========================================

    public function __construct($idCategoria)
    {
        $this->idCategoria = $idCategoria;
    }

    // =========================================
    public function toResponse($request)
    {
        try {
            $categoria = Categoria::leftJoin('estados', 'estados.id_estado', '=', 'categorias.id_estado')
                ->select(
                    'id_categoria',
                    'categoria',
                    'categorias.id_estado',
                    'estados.estado'
                )
                ->orderByDesc('categoria')
                ->where('id_categoria', $this->idCategoria)
                ->first();

            if (isset($categoria) && !is_null($categoria) && !empty($categoria)) {
                return response()->json($categoria);
            }

        } catch (Exception $e) {
            return response()->json(['error_bd' => $e->getMessage()], 500);
        }
    }
}
