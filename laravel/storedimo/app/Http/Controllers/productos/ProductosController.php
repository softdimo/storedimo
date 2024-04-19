<?php

namespace App\Http\Controllers\productos;

use Exception;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Producto;
use App\Http\Responsable\productos\ProductoStore;
use App\Http\Responsable\productos\ProductoShow;
use App\Http\Responsable\productos\ProductoEdit;
use App\Http\Responsable\productos\ProductoUpdate;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Exception\RequestException;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Realiza la solicitud GET a la API
        $clientApi = new Client([
            'base_uri' => 'http://localhost:8000/api/producto_index',
            'headers' => [],
        ]);

        $response = $clientApi->request('GET');
        $res = $response->getBody()->getContents();
        $productos = json_decode($res, true);

        if(isset($productos) && !empty($productos)) {
            $this->shareData();
            return view('productos.index', compact('productos'));
        } else {
            $this->shareData();
            return view('productos.index');
        }
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
        $this->shareData();
        return view('productos.create');
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
                // dd($request);
        // try {
        //     $sesion = $this->validarVariablesSesion();

        //     if (empty($sesion[0]) || is_null($sesion[0]) &&
        //         empty($sesion[1]) || is_null($sesion[1]) &&
        //         empty($sesion[2]) || is_null($sesion[2]) && !$sesion[3])
        //     {
        //         return view('inicio_sesion.login');
        //     } else {
            return new ProductoStore();
            //     }
    
            // } catch (Exception $e) {
            //     dd($e);
            //     alert()->error("Ha ocurrido un error!");
            //     return redirect()->to(route('login'));
            // }
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
        // try {
        //     $sesion = $this->validarVariablesSesion();

        //     if (empty($sesion[0]) || is_null($sesion[0]) &&
        //         empty($sesion[1]) || is_null($sesion[1]) &&
        //         empty($sesion[2]) || is_null($sesion[2]) && !$sesion[3])
        //     {
        //         return view('inicio_sesion.login');
        //     } else {
                return new ProductoShow($idProducto);
        //     }
        // } catch (Exception $e) {
        //     dd($e);
        //     alert()->error("Ha ocurrido un error!");
        //     return redirect()->to(route('login'));
        // }
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
        // try {
        //     $sesion = $this->validarVariablesSesion();

        //     if (empty($sesion[0]) || is_null($sesion[0]) &&
        //         empty($sesion[1]) || is_null($sesion[1]) &&
        //         empty($sesion[2]) || is_null($sesion[2]) && !$sesion[3])
        //     {
        //         return view('inicio_sesion.login');
        //     } else {
                    return new ProductoEdit($idProducto);
        //     }
        // } catch (Exception $e) {
        //     dd($e);
        //     alert()->error("Ha ocurrido un error!");
        //     return redirect()->to(route('login'));
        // }
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
    public function update(Request $request, $idProducto)
    {
        // try {
        //     $producto = Producto::leftJoin('categorias', 'categorias.id_categoria', '=', 'productos.id_categoria')
        //         ->select(
        //             'id_producto',
        //             'nombre_producto',
        //             'categorias.id_categoria',
        //             'categorias.categoria',
        //             'descripcion',
        //             'stock_minimo',
        //             'precio_unitario',
        //             'precio_detal',
        //             'precio_por_mayor'
        //         )
        //         ->where('id_producto', $idProducto)
        //         ->first();

        //     if (isset($producto) && !is_null($producto) && !empty($producto)) {
        //         return response()->json($producto);
        //     } else {
        //         return response()->json([
        //             'message' => 'No existe producto'
        //         ], 404);
        //     }
        // } catch (Exception $e) {
        //     return response()->json([
        //         'message' => 'Error consultando la base de datos',
        //         'error' => $e->getMessage(),
        //     ], 500);
        // }

        // try {
        //     $sesion = $this->validarVariablesSesion();

        //     if (empty($sesion[0]) || is_null($sesion[0]) &&
        //         empty($sesion[1]) || is_null($sesion[1]) &&
        //         empty($sesion[2]) || is_null($sesion[2]) && !$sesion[3])
        //     {
        //         return view('inicio_sesion.login');
        //     } else {
                    // return new ProductoUpdate($idProducto);
        //     }
        // } catch (Exception $e) {
        //     dd($e);
        //     alert()->error("Ha ocurrido un error!");
        //     return redirect()->to(route('login'));
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

    // ======================================================================
    // ======================================================================
    
    private function shareData()
    {
        view()->share('categorias', Categoria::orderBy('categoria','asc')->pluck('categoria', 'id_categoria'));
        // view()->share('tipo_documento', tipoDocumento::orderBy('tipo_documento','asc')->pluck('tipo_documento', 'id_tipo_documento'));
        // view()->share('generos', Genero::orderBy('genero','asc')->pluck('genero', 'id_genero'));
    }
}
