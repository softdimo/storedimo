<?php

namespace App\Http\Controllers\productos;

use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Responsable\productos\ProductoIndex;
use App\Http\Responsable\productos\ProductoStore;
use App\Http\Responsable\productos\ProductoShow;
use App\Http\Responsable\productos\ProductoEdit;
use App\Http\Responsable\productos\ProductoUpdate;
use App\Http\Responsable\productos\ProductoDestroy;
use App\Http\Responsable\productos\ProductoQueryBarCode;
use App\Http\Responsable\productos\ProductoGenerarBarCode;
use App\Http\Responsable\productos\ReporteProductosPdf;
use GuzzleHttp\Client;
use App\Traits\MetodosTrait;

class ProductosController extends Controller
{
    use MetodosTrait;
    protected $baseUri;
    protected $clientApi;

    public function __construct()
    {
        $this->shareData();
        $this->baseUri = env('BASE_URI');
        $this->clientApi = new Client(['base_uri' => $this->baseUri]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            if (!$this->checkDatabaseConnection()) {
                return view('db_conexion');
            } else {
                $sesion = $this->validarVariablesSesion();
    
                if (empty($sesion[0]) || is_null($sesion[0]) &&
                    empty($sesion[1]) || is_null($sesion[1]) &&
                    empty($sesion[2]) || is_null($sesion[2]) && !$sesion[3])
                {
                    return redirect()->to(route('login'));
                } else {
                    return new ProductoIndex();
                }
            }
        } catch (Exception $e) {
            alert()->error("Exception Index Productos!");
            return back();
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
        try {
            if (!$this->checkDatabaseConnection()) {
                return view('db_conexion');
            } else {
                $sesion = $this->validarVariablesSesion();
    
                if (empty($sesion[0]) || is_null($sesion[0]) &&
                    empty($sesion[1]) || is_null($sesion[1]) &&
                    empty($sesion[2]) || is_null($sesion[2]) && !$sesion[3])
                {
                    return redirect()->to(route('login'));
                } else {
                    return view('productos.create');
                }
            }
        } catch (Exception $e) {
            alert()->error("Exception Create Productos!");
            return back();
        }
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
        try {
            if (!$this->checkDatabaseConnection()) {
                return view('db_conexion');
            } else {
                $sesion = $this->validarVariablesSesion();
    
                if (empty($sesion[0]) || is_null($sesion[0]) &&
                    empty($sesion[1]) || is_null($sesion[1]) &&
                    empty($sesion[2]) || is_null($sesion[2]) && !$sesion[3])
                {
                    return redirect()->to(route('login'));
                } else {
                    return new ProductoStore();
                }
            }
        } catch (Exception $e) {
            alert()->error("Exception Store Productos!");
            return back();
        }
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
        try {
            if (!$this->checkDatabaseConnection()) {
                return view('db_conexion');
            } else {
                $sesion = $this->validarVariablesSesion();
    
                if (empty($sesion[0]) || is_null($sesion[0]) &&
                    empty($sesion[1]) || is_null($sesion[1]) &&
                    empty($sesion[2]) || is_null($sesion[2]) && !$sesion[3])
                {
                    return redirect()->to(route('login'));
                } else {
                    return new ProductoShow($idProducto);
                }
            }
        } catch (Exception $e) {
            alert()->error("Exception Show Productos!");
            return back();
        }
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
        try {
            if (!$this->checkDatabaseConnection()) {
                return view('db_conexion');
            } else {
                $sesion = $this->validarVariablesSesion();
    
                if (empty($sesion[0]) || is_null($sesion[0]) &&
                    empty($sesion[1]) || is_null($sesion[1]) &&
                    empty($sesion[2]) || is_null($sesion[2]) && !$sesion[3])
                {
                    return redirect()->to(route('login'));
                } else {
                    return new ProductoEdit($idProducto);
                }
            }
        } catch (Exception $e) {
            alert()->error("Exception Edit Productos!");
            return back();
        }
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
    public function update(Request $request)
    {
        try {
            if (!$this->checkDatabaseConnection()) {
                return view('db_conexion');
            } else {
                $sesion = $this->validarVariablesSesion();
    
                if (empty($sesion[0]) || is_null($sesion[0]) &&
                    empty($sesion[1]) || is_null($sesion[1]) &&
                    empty($sesion[2]) || is_null($sesion[2]) && !$sesion[3])
                {
                    return redirect()->to(route('login'));
                } else {
                    return new ProductoUpdate();
                }
            }
        } catch (Exception $e) {
            alert()->error("Exception Update Productos!");
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
    public function destroy()
    {
        try {
            if (!$this->checkDatabaseConnection()) {
                return view('db_conexion');
            } else {
                $sesion = $this->validarVariablesSesion();
    
                if (empty($sesion[0]) || is_null($sesion[0]) &&
                    empty($sesion[1]) || is_null($sesion[1]) &&
                    empty($sesion[2]) || is_null($sesion[2]) && !$sesion[3])
                {
                    return redirect()->to(route('login'));
                } else {
                    return new ProductoDestroy();
                }
            }
        } catch (Exception $e) {
            alert()->error("Exception Destroy Productos!");
            return back();
        }
    }

    // ======================================================================
    // ======================================================================

    public function verificarProducto(Request $request)
    {
        try {
            if (!$this->checkDatabaseConnection()) {
                return view('db_conexion');
            } else {
                $sesion = $this->validarVariablesSesion();

                if (empty($sesion[0]) || is_null($sesion[0]) &&
                    empty($sesion[1]) || is_null($sesion[1]) &&
                    empty($sesion[2]) || is_null($sesion[2]) && !$sesion[3])
                {
                    return redirect()->to(route('login'));
                } else {
                    $baseUri = env('BASE_URI');
                    $clientApi = new Client(['base_uri' => $baseUri]);

                    try {
                        $nombreProducto = request('nombre_producto', null);
                        $idCategoria = request('id_categoria', null);

                        $verificarProducto = $clientApi->post($baseUri.'verificar_producto', [
                            'query' => [
                                'nombre_producto' => $nombreProducto,
                                'id_categoria' => $idCategoria,
                            ]
                        ]);
                        $resVerificarProducto = json_decode($verificarProducto->getBody()->getContents());
        
                        if( isset($resVerificarProducto) && !empty($resVerificarProducto) && !is_null($resVerificarProducto) ) {
                            return response()->json('existe_producto');
                        }
                    } catch (Exception $e) {
                        return response()->json('error_exception');
                    }
                }
            }
        } catch (Exception $e) {
            alert()->error("Exception Update Usuario!");
            return redirect()->to(route('login'));
        }
    }

    // ======================================================================
    // ======================================================================
    
    public function queryBarCodeProducto($idProducto)
    {
        try {
            if (!$this->checkDatabaseConnection()) {
                return view('db_conexion');
            } else {
                $sesion = $this->validarVariablesSesion();
    
                if (empty($sesion[0]) || is_null($sesion[0]) &&
                    empty($sesion[1]) || is_null($sesion[1]) &&
                    empty($sesion[2]) || is_null($sesion[2]) && !$sesion[3])
                {
                    return redirect()->to(route('login'));
                } else {
                    return new ProductoQueryBarCode($idProducto);
                }
            }
        } catch (Exception $e) {
            alert()->error("Exception Query BarCode Productos!");
            return back();
        }
    }

    // ======================================================================
    // ======================================================================
        
    public function productoGenerarBarCode()
    {
        try {
            if (!$this->checkDatabaseConnection()) {
                return view('db_conexion');
            } else {
                $sesion = $this->validarVariablesSesion();
    
                if (empty($sesion[0]) || is_null($sesion[0]) &&
                    empty($sesion[1]) || is_null($sesion[1]) &&
                    empty($sesion[2]) || is_null($sesion[2]) && !$sesion[3])
                {
                    return redirect()->to(route('login'));
                } else {
                    return new ProductoGenerarBarCode();
                }
            }
        } catch (Exception $e) {
            alert()->error("Exception GenerarBarCode Productos!");
            return back();
        }
    }
    
    // ======================================================================
    // ======================================================================

    public function queryValoresProducto()
    {
        $idProducto = request('id_producto', null);

        try {
            if (!$this->checkDatabaseConnection()) {
                return view('db_conexion');
            } else {
                $sesion = $this->validarVariablesSesion();
    
                if (empty($sesion[0]) || is_null($sesion[0]) &&
                    empty($sesion[1]) || is_null($sesion[1]) &&
                    empty($sesion[2]) || is_null($sesion[2]) && !$sesion[3])
                {
                    return redirect()->to(route('login'));
                } else {
                    try {
                        $queryValoresProducto = $this->clientApi->post($this->baseUri.'query_producto/'.$idProducto, ['query' => []]);
                        return json_decode($queryValoresProducto->getBody()->getContents());
                        
                    } catch (Exception $e) {
                        alert()->error('Error', 'Excepción, si el problema persiste, contacte a Soporte.' . $e->getMessage());
                        return back();
                    }
                }
            }
        } catch (Exception $e) {
            alert()->error("Exception GenerarBarCode Productos!");
            return back();
        }
    }
    
    // ======================================================================
    // ======================================================================
        
    public function reporteProductosPdf()
    {
        try {
            if (!$this->checkDatabaseConnection()) {
                return view('db_conexion');
            } else {
                $sesion = $this->validarVariablesSesion();
    
                if (empty($sesion[0]) || is_null($sesion[0]) &&
                    empty($sesion[1]) || is_null($sesion[1]) &&
                    empty($sesion[2]) || is_null($sesion[2]) && !$sesion[3])
                {
                    return redirect()->to(route('login'));
                } else {
                    return new ReporteProductosPdf();
                }
            }
        } catch (Exception $e) {
            alert()->error("Exception ReporteProductosPdf!");
            return back();
        }
    }
    
    // ======================================================================
    // ======================================================================
}
