<?php

namespace App\Http\Controllers\categorias;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Responsable\categorias\CategoriaStore;
use App\Http\Responsable\categorias\CategoriaUpdate;
use GuzzleHttp\Client;


class CategoriasController extends Controller
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
            'base_uri' => 'http://localhost:8000/api/categoria_index',
            'headers' => [],
        ]);

        $response = $clientApi->request('GET');
        $res = $response->getBody()->getContents();
        $categorias = json_decode($res, true);

        if(isset($categorias) && !empty($categorias)) {
            return view('categorias.index', compact('categorias'));
        } else {
            return view('categorias.index');
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
        // dd($request);
        // try {
        //     $sesion = $this->validarVariablesSesion();

        //     if (empty($sesion[0]) || is_null($sesion[0]) &&
        //         empty($sesion[1]) || is_null($sesion[1]) &&
        //         empty($sesion[2]) || is_null($sesion[2]) && !$sesion[3])
        //     {
        //         return view('inicio_sesion.login');
        //     } else {
                return new CategoriaStore();
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
    public function update(Request $request)
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
            return new CategoriaUpdate();
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
}
