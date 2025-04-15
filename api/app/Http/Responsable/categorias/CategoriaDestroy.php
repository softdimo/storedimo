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
                $categoria->id_estado = 2;
            } else {
                $categoria->id_estado = 1;
            }

            $categoria->save();

            
            return response()->json(['success' => true]);
            

        } catch (Exception $e) {
            return response()->json(['error_bd' => $e->getMessage()]);
        }
    }
}