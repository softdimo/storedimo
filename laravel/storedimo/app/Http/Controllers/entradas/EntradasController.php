<?php

namespace App\Http\Controllers\entradas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Traits\MetodosTrait;
use Exception;
use App\Http\Responsable\entradas\EntradaIndex;
use App\Http\Responsable\entradas\EntradaStore;
use App\Http\Responsable\entradas\EntradaUpdate;
use App\Http\Responsable\entradas\ReporteComprasPdf;
use App\Http\Responsable\entradas\DetalleComprasPdf;


class EntradasController extends Controller
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

    // ======================================================================
    // ======================================================================

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
                    return new EntradaIndex();
                }
            }
        } catch (Exception $e) {
            alert()->error("Exception Index Entradas!");
            return redirect()->to(route('login'));
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
                    return view('entradas.create');
                }
            }
        } catch (Exception $e) {
            alert()->error("Exception Index Existencias!");
            return redirect()->to(route('login'));
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
                    return new EntradaStore();
                }
            }
        } catch (Exception $e) {
            alert()->error("Exception Index Existencias!");
            return redirect()->to(route('login'));
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

    public function anularCompra(Request $request)
    {
        $idCompra = request('id_compra', null);

        try {
            $reqAnularCompra = $this->clientApi->post($this->baseUri.'anular_compra/'.$idCompra, ['json' => []]);
            $resAnularCompra = json_decode($reqAnularCompra->getBody()->getContents());

            if(isset($resAnularCompra) && !empty($resAnularCompra) && !is_null($resAnularCompra)) {
                alert()->success('Proceso Exitoso', 'Estado compra cambiado satisfactoriamente');
                return redirect()->to(route('entradas.index'));
            }
        } catch (Exception $e) {
            alert()->error('Error', 'Exception, contacte a Soporte.' . $e->getMessage());
            return back();
        }
    }
        
    // ======================================================================
    // ======================================================================

    public function reporteComprasPdf()
    {
        return new ReporteComprasPdf();
    }

    // ======================================================================
    // ======================================================================

    public function detalleComprasPdf($idCompra)
    {
        return new DetalleComprasPdf($idCompra);
    }
}
