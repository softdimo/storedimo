<?php

namespace App\Http\Controllers\productos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Http\Responsable\productos\ProductoIndex;
use App\Http\Responsable\productos\ProductoStore;
use App\Http\Responsable\productos\ProductoShow;
use App\Http\Responsable\productos\ProductoEdit;
use App\Http\Responsable\productos\ProductoUpdate;
use App\Models\Producto;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new ProductoIndex();
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
        return new ProductoStore();
    }

    // ======================================================================
    // ======================================================================    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($idProducto)
    {
        return new ProductoShow($idProducto);
    }

    // ======================================================================
    // ======================================================================

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($idProducto)
    {
        return new ProductoEdit($idProducto);
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
        return new ProductoUpdate($idProducto);

        $idProducto = request('idProductoEdit', null);
        $nombreProductoEdit = request('nombreProductoEdit', null);
        $categoriaEdit = request('categoriaEdit', null);
        $descripcionEdit = request('descripcionEdit', null);
        $precioUnitarioEdit = request('precioUnitarioEdit', null);
        $precioPorMayorEdit = request('precioPorMayorEdit', null);
        $precioDetalEdit = request('precioDetalEdit', null);
        $stockMinimoEdit = request('stockMinimoEdit', null);

        DB::connection('pgsql')->beginTransaction();

        try {
            $productoUpdate = Producto::where('id_producto',$idProducto)
                ->update([
                    'id_producto' => $idProducto,
                    'nombre_producto' => $nombreProductoEdit,
                    'categorias.id_categoria' => $categoriaEdit,
                    'descripcion' => $descripcionEdit,
                    'stock_minimo' => $stockMinimoEdit,
                    'precio_unitario' => $precioUnitarioEdit,
                    'precio_detal' => $precioDetalEdit,
                    'precio_por_mayor' => $precioPorMayorEdit
                ]);

            if ($productoUpdate) {
                DB::connection('pgsql')->commit();
                alert()->success('Proceso Exitoso', 'Producto editado satisfactoriamente');
                return redirect('productos');
            } else {
                DB::connection('pgsql')->rollback();
                alert()->success('Error', 'Producto No editado');
                return redirect('productos');
            }
        } catch (Exception $e) {
            // return response()->json([
            //     'message' => 'Error consultando la base de datos',
            //     'error' => $e->getMessage(),
            // ], 500);
            DB::connection('pgsql')->rollback();
            alert()->error('Error', 'Excepción, intente de nuevo, si el problema persiste, contacte a Soporte.');
            return back();
        }
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
