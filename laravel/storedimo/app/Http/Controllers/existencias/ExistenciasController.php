<?php

namespace App\Http\Controllers\existencias;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Traits\MetodosTrait;
use Exception;
use App\Http\Responsable\existencias\BajaIndex;
use App\Http\Responsable\existencias\BajaStore;
use App\Http\Responsable\existencias\ReporteBajasPdf;
use App\Http\Responsable\existencias\StockMinimo;
class ExistenciasController extends Controller
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
        // try {
        //     if (!$this->checkDatabaseConnection()) {
        //         return view('db_conexion');
        //     } else {
        //         $sesion = $this->validarVariablesSesion();

        //         if (empty($sesion[0]) || is_null($sesion[0]) &&
        //             empty($sesion[1]) || is_null($sesion[1]) &&
        //             empty($sesion[2]) || is_null($sesion[2]) && !$sesion[3])
        //         {
        //             return redirect()->to(route('login'));
        //         } else {
        //             return view('existencias.index');
        //         }
        //     }
        // } catch (Exception $e) {
        //     alert()->error("Exception Index Existencias!");
        //     return redirect()->to(route('login'));
        // }
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
                    return view('existencias.create');
                }
            }
        } catch (Exception $e) {
            alert()->error("Exception Create Existencias!");
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
        //
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

    public function bajasIndex()
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
                    return new BajaIndex();
                }
            }
        } catch (Exception $e) {
            alert()->error("Exception Index Bajas!");
            return redirect()->to(route('login'));
        }
    }

    // ======================================================================
    // ======================================================================

    public function bajaStore()
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
                    return new BajaStore();
                }
            }
        } catch (Exception $e) {
            alert()->error("Exception BajaStore Existencias!");
            return redirect()->to(route('login'));
        }
    }
    
    // ======================================================================
    // ======================================================================

    public function reporteBajasPdf()
    {
        return new ReporteBajasPdf();
    }
    
    // ======================================================================
    // ======================================================================

    public function stockMinimo()
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
                    return new StockMinimo();
                }
            }
        } catch (Exception $e) {
            alert()->error("Exception stockMinimo!");
            return redirect()->to(route('login'));
        }
    }
}
