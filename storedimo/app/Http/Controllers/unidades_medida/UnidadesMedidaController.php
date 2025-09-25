<?php

namespace App\Http\Controllers\unidades_medida;

use Exception;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Responsable\unidades_medida\UnidadMedidaIndex;
use App\Http\Responsable\unidades_medida\UnidadMedidaStore;
use App\Http\Responsable\unidades_medida\UnidadMedidaEdit;
use App\Http\Responsable\unidades_medida\UnidadMedidaUpdate;
use GuzzleHttp\Client;
use App\Traits\MetodosTrait;

class UnidadesMedidaController extends Controller
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
        try
        {
            if (!$this->checkDatabaseConnection()) {
                return view('db_conexion');
            } else
            {
                $sesion = $this->validarVariablesSesion();
    
                if (empty($sesion[0]) || is_null($sesion[0]) &&
                    empty($sesion[1]) || is_null($sesion[1]) &&
                    empty($sesion[2]) || is_null($sesion[2]) && !$sesion[3])
                {
                    return redirect()->to(route('login'));
                } else
                {
                    $vista = new UnidadMedidaIndex();
                    return $this->validarAccesos($sesion[0], 66, $vista);
                }
            }
        } catch (Exception $e)
        {
            alert()->error("Exception Index Unidades Medida!");
            return back();
        }
    }

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        try
        {
            if (!$this->checkDatabaseConnection())
            {
                return view('db_conexion');
            } else
            {
                $sesion = $this->validarVariablesSesion();
    
                if (empty($sesion[0]) || is_null($sesion[0]) &&
                    empty($sesion[1]) || is_null($sesion[1]) &&
                    empty($sesion[2]) || is_null($sesion[2]) && !$sesion[3])
                {
                    return redirect()->to(route('login'));
                } else
                {
                    $vista = new UnidadMedidaStore();
                    return $this->validarAccesos($sesion[0], 66, $vista);
                }
            }
        } catch (Exception $e)
        {
            alert()->error("Exception Store Unidades Medida!");
            return back();
        }
    }

    // ======================================================================

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

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
            if (!$this->checkDatabaseConnection())
            {
                return view('db_conexion');
            } else
            {
                $sesion = $this->validarVariablesSesion();
    
                if (empty($sesion[0]) || is_null($sesion[0]) &&
                    empty($sesion[1]) || is_null($sesion[1]) &&
                    empty($sesion[2]) || is_null($sesion[2]) && !$sesion[3])
                {
                    return redirect()->to(route('login'));
                } else
                {
                    $categorias = $this->categoriasTrait();
                    $umd = $this->UmdTrait();
                    return new UnidadMedidaEdit($idProducto, $categorias, $umd);
                }
            }
        } catch (Exception $e)
        {
            alert()->error("Exception Edit Unidades Medida!");
            return back();
        }
    }

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
            } else
            {
                $sesion = $this->validarVariablesSesion();
    
                if (empty($sesion[0]) || is_null($sesion[0]) &&
                    empty($sesion[1]) || is_null($sesion[1]) &&
                    empty($sesion[2]) || is_null($sesion[2]) && !$sesion[3])
                {
                    return redirect()->to(route('login'));
                } else
                {
                    $vista = new UnidadMedidaUpdate();
                    return $this->validarAccesos($sesion[0], 28, $vista);
                }
            }
        } catch (Exception $e)
        {
            alert()->error("Exception Update Unidades Medida!");
            return back();
        }
    }

    // ======================================================================

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }

    // ======================================================================

    // public function verificarUmd(Request $request)
    // {
    //     try
    //     {
    //         if (!$this->checkDatabaseConnection())
    //         {
    //             return view('db_conexion');
    //         } else {
    //             $sesion = $this->validarVariablesSesion();

    //             if (empty($sesion[0]) || is_null($sesion[0]) &&
    //                 empty($sesion[1]) || is_null($sesion[1]) &&
    //                 empty($sesion[2]) || is_null($sesion[2]) && !$sesion[3])
    //             {
    //                 return redirect()->to(route('login'));
    //             } else {
    //                 $baseUri = env('BASE_URI');
    //                 $clientApi = new Client(['base_uri' => $baseUri]);

    //                 try {
    //                     $nombreProducto = request('nombre_producto', null);
    //                     $idCategoria = request('id_categoria', null);

    //                     $verificarProducto = $clientApi->post($baseUri.'verificar_producto', [
    //                         'query' => [
    //                             'nombre_producto' => $nombreProducto,
    //                             'id_categoria' => $idCategoria,
    //                             'empresa_actual' => session('empresa_actual.id_empresa')
    //                         ]
    //                     ]);
    //                     $resVerificarProducto = json_decode($verificarProducto->getBody()->getContents());
        
    //                     if( isset($resVerificarProducto) && !empty($resVerificarProducto) && !is_null($resVerificarProducto) ) {
    //                         return response()->json('existe_producto');
    //                     }
    //                 } catch (Exception $e) {
    //                     return response()->json('error_exception');
    //                 }
    //             }
    //         }
    //     } catch (Exception $e)
    //     {
    //         alert()->error("Exception Verificar unidad de medida!");
    //         return redirect()->to(route('login'));
    //     }
    // }

    // ======================================================================
    
    public function UmdTrait()
    {
        try
        {
            $response = $this->clientApi->get('umd_trait', [
                'query' => ['empresa_actual' => session('empresa_actual.id_empresa')]
            ]);

            return json_decode($response->getBody()->getContents());

        } catch (Exception $e)
        {
            alert()->error('Error', 'Error obteniendo unidades de medida');
            return back();
        }
    }
}
