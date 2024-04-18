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
            return view('productos.index', compact('productos'));
        } else {
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

        // try {
        //     $response = Http::post('http://localhost:8000/api/producto_show/'.$idProducto);
    
        //     if ($response->successful()) {
        //         return $response->json();
        //     } else {
        //         return response()->json([
        //             'message' => 'No se pudo obtener el producto'
        //         ], $response->status());
        //     }
        // } catch (Exception $e) {
        //     return response()->json([
        //         'message' => 'Error en la solicitud HTTP',
        //         'error' => $e->getMessage(),
        //     ], 500);
        // }

        // $client = new Client([
        //     'base_uri' => 'http://localhost:8000/api/',
        //     'headers' => [
        //         'Accept' => 'application/json',
        //         'Content-Type' => 'application/json',
        //     ],
        // ]);
    
        // try {
        //     $response = $client->request('POST', 'producto_show/'.$idProducto);
    
        //     if ($response->getStatusCode() == 200) {
        //         $producto = json_decode($response->getBody()->getContents(), true);
        //         return response()->json($producto);
        //     } else {
        //         return response()->json([
        //             'message' => 'No se pudo obtener el producto',
        //             'status' => $response->getStatusCode()
        //         ], $response->getStatusCode());
        //     }
        // } catch (RequestException $e) {
        //     return response()->json([
        //         'message' => 'Error en la solicitud HTTP',
        //         'error' => $e->getMessage(),
        //     ], 500);
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
        //
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
