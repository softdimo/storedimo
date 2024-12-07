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
    public function index()
    {
        try {
            // Crear una instancia del cliente Guzzle para realizar la solicitud HTTP
            $clientApi = new Client([
                'base_uri' => 'http://host.docker.internal:8080/api/categoria_index',
                'headers' => [],
            ]);

            // Realizar la solicitud GET a la API
            $response = $clientApi->request('GET');

            // Obtener el cuerpo de la respuesta y convertirlo en un array asociativo
            $res = $response->getBody()->getContents();
            $categorias = json_decode($res, true);

            // Verificar si la variable 'categorias' está definida, es un array y contiene elementos
            if (isset($categorias) && is_array($categorias) && count($categorias) > 0) {
                // Si contiene datos, retornar la vista pasando las categorías
                return view('categorias.index', compact('categorias'));
            }

            // Si no contiene datos, retornar la vista sin pasar ninguna categoría
            return view('categorias.index', compact('categorias'));

        } catch (\Exception $e) {
            // Captura cualquier error que ocurra durante el proceso y muestra un mensaje de error
            return view('categorias.index')->withErrors('Error al obtener las categorías: ' . $e->getMessage());
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
