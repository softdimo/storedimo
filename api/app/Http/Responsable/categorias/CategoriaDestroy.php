<?php

namespace App\Http\Responsable\categorias;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Categoria;

class CategoriaDestroy implements Responsable
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
        $idCategoria = $this->idCategoria;

        $categoria = Categoria::where('id_categoria', $idCategoria)->first();
        // dd($categoria);

        $idEstado = $categoria->id_estado;

        try {
            if ($idEstado == 1) {
                $cambiarEstadoCategoria = Categoria::where('id_categoria', $idCategoria)->update(['id_estado' => 2,]);
            } else {
                $cambiarEstadoCategoria = Categoria::where('id_categoria', $idCategoria)->update(['id_estado' => 1,]);
            }

            if (isset($cambiarEstadoCategoria) && !is_null($cambiarEstadoCategoria) && !empty($cambiarEstadoCategoria)) {
                return response()->json(['success' => true]);
            } else {
                return response()->json(['message' => 'No existe categoría'], 404);
            }
        } catch (Exception $e) {
            return response()->json(['error_bd' => $e->getMessage()]);
        }
    }
}