<?php

namespace App\Http\Responsable\categorias;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Categoria;

class CategoriaIndex implements Responsable
{
    public function toResponse($request)
    {
        try {
            $categorias = Categoria::leftJoin('estados', 'estados.id_estado', '=', 'categorias.id_estado')
            ->select(
                'id_categoria', 
                'categoria',
                'categorias.id_estado',
                'estados.estado'
                )->orderBy('categoria', 'ASC')->get();

            if (isset($categorias) && !is_null($categorias) && !empty($categorias)) {
                return response()->json($categorias);
            } else {
                return response()->json([
                    'message' => 'no hay categorias'
                ], 404);
            }
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Error en la consulta de la base de datos',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
