<?php

namespace App\Http\Controllers\categorias;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Responsable\categorias\CategoriaIndex;
use App\Http\Responsable\categorias\CategoriaStore;
use App\Http\Responsable\categorias\CategoriaUpdate;
use App\Models\Categoria;


class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new CategoriaIndex();
    }

    // ======================================================================
    // ======================================================================

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    // ======================================================================
    // ======================================================================

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return new CategoriaStore();
    }

    // ======================================================================
    // ======================================================================

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    // ======================================================================
    // ======================================================================

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    // ======================================================================
    // ======================================================================

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request, $id);
        return new CategoriaUpdate();

        // $categoria = Categoria::find($id);

        // if (isset($categoria) && !is_null($categoria) && !empty($categoria)) {
        //     $categoria->categoria = $request->input('categoria');
        //     $categoria->update();

        //     return response()->json([
        //         'success' => true,
        //         'message' => 'La categoría se actualizó correctamente'
        //     ]);
        // } else {
        //     return abort(404, $message = 'No existe esta categoria');
        // }
    }

    // ======================================================================
    // ======================================================================

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
