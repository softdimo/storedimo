<?php

namespace App\Http\Controllers\personas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use App\Http\Controllers\admin\AdministradorController;
use App\Models\TipoPersona;
use App\Models\TipoDocumento;
use App\Models\Genero;

class PersonasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // try {
            // $adminCtrl = new AdministradorController();
            // $sesion = $adminCtrl->validarVariablesSesion();

            // if (empty($sesion[0]) || is_null($sesion[0]) &&
            //     empty($sesion[1]) || is_null($sesion[1]) &&
            //     empty($sesion[2]) || is_null($sesion[2]) && !$sesion[3])
            // {
            //     return view('inicio_sesion.login');
            // } else {
            //     $usuLogueado = session('id_usuario');
                // $usuario = Usuario::select('nombres')->where('id_usuario',$usuLogueado)->first();
                return view('personas.index');
        //     }
        // } catch (Exception $e) {
        //     alert()->error("Error Exception!");
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
        $this->shareData();
        return view('personas.create');
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

    private function shareData()
    {
        view()->share('tipo_persona', TipoPersona::orderBy('id_tipo_persona','asc')->pluck('tipo_persona', 'id_tipo_persona'));
        view()->share('tipo_documento', tipoDocumento::orderBy('tipo_documento','asc')->pluck('tipo_documento', 'id_tipo_documento'));
        view()->share('generos', Genero::orderBy('genero','asc')->pluck('genero', 'id_genero'));
    }

    // ======================================================================
    // ======================================================================

    public function listarProveedores()
    {
        return view('personas.listar_proveedores');
    }
    
    // ======================================================================
    // ======================================================================

    public function listarClientes()
    {
        return view('personas.listar_clientes');
    }
}