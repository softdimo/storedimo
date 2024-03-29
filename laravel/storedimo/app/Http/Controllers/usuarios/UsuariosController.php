<?php

namespace App\Http\Controllers\usuarios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use App\Http\Controllers\admin\AdministradorController;
use App\Models\Usuario;

class UsuariosController extends Controller
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
                return view('usuarios.index');
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
        return view('usuarios.create');
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

    public function listarProveedores()
    {
        return view('usuarios.listar_proveedores');
    }
    
    // ======================================================================
    // ======================================================================

    public function listarClientes()
    {
        return view('usuarios.listar_clientes');
    }
}