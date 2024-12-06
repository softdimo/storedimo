<?php

namespace App\Http\Controllers\categorias;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Responsable\categorias\CategoriaStore;
use App\Http\Responsable\categorias\CategoriaUpdate;
use GuzzleHttp\Client;
use App\Models\Categoria;
use Illuminate\Support\Facades\DB;


class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /* public function index()
    {
        //$categorias = Categoria::select('id_categoria', 'categoria')->orderBy('categoria', 'ASC')->get();

        $clientApi = new Client([
            'base_uri' => 'http://host.docker.internal:8080/api/categoria_index',
            // 'base_uri' => 'http://storedimolaravel:8000/api/categoria_index',
            'headers' => [],
        ]);

        $response = $clientApi->request('GET');
        $res = $response->getBody()->getContents();
        $categorias = json_decode($res, true);

        if(isset($categorias) && !empty($categorias)) {
            dd($categorias);
            return view('categorias.index', compact('categorias'));
        } else {
            //dd($categorias);
            return view('categorias.index');
        }
    } */

    public function index()
    {
        try {
            $clientApi = new Client([
                'base_uri' => 'http://host.docker.internal:8080/api/categoria_index',
            ]);


            $response = $clientApi->request('GET');
            $res = $response->getBody()->getContents();

            #var_dump($res, true);
            #die();

            $categorias = json_decode($res, true);

            // Verifica si el formato de la respuesta es correcto
            if (isset($categorias) && is_array($categorias) && !empty($categorias)) {
                return view('categorias.index', compact('categorias'));
            } else {
                // Maneja el caso donde la respuesta es vacía o no válida
                return view('categorias.index')->withErrors('No se encontraron categorías.');
            }
        } catch (\Exception $e) {
            // Captura errores de conexión o de la API
            return view('categorias.index')->withErrors('Error al conectar con la API: ' . $e->getMessage());
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
            //return new CategoriaUpdate();
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
