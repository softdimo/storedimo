<?php

namespace App\Http\Controllers\usuarios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use App\Http\Controllers\admin\AdministradorController;
use App\Http\Responsable\usuarios\UsuarioIndex;
use App\Http\Responsable\usuarios\UsuarioStore;
use App\Http\Responsable\usuarios\UsuarioUpdate;
use GuzzleHttp\Client;
use App\Traits\MetodosTrait;
use Illuminate\Validation\ValidationException;


class UsuariosController extends Controller
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

                if (
                    empty($sesion[0]) || is_null($sesion[0]) &&
                    empty($sesion[1]) || is_null($sesion[1]) &&
                    empty($sesion[2]) || is_null($sesion[2]) && !$sesion[3]
                ) {
                    return redirect()->to(route('login'));
                } else {
                    return new UsuarioIndex();
                }
            }
        } catch (Exception $e) {
            alert()->error("Exception Index Usuario!");
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

                if (
                    empty($sesion[0]) || is_null($sesion[0]) &&
                    empty($sesion[1]) || is_null($sesion[1]) &&
                    empty($sesion[2]) || is_null($sesion[2]) && !$sesion[3]
                ) {
                    return redirect()->to(route('login'));
                } else {
                    return view('usuarios.create');
                }
            }
        } catch (Exception $e) {
            alert()->error("Exception Create Usuario!");
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

                if (
                    empty($sesion[0]) || is_null($sesion[0]) &&
                    empty($sesion[1]) || is_null($sesion[1]) &&
                    empty($sesion[2]) || is_null($sesion[2]) && !$sesion[3]
                ) {
                    return redirect()->to(route('login'));
                } else {
                    return new UsuarioStore();
                }
            }
        } catch (Exception $e) {
            alert()->error("Exception Store Usuario!");
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
    public function edit($idUsuario)
    {
        try {
            if (!$this->checkDatabaseConnection()) {
                return view('db_conexion');
            } else {
                $sesion = $this->validarVariablesSesion();

                if (
                    empty($sesion[0]) || is_null($sesion[0]) &&
                    empty($sesion[1]) || is_null($sesion[1]) &&
                    empty($sesion[2]) || is_null($sesion[2]) && !$sesion[3]
                ) {
                    return redirect()->to(route('login'));
                } else {
                    $usuario = $this->queryUsuarioUpdate($idUsuario);

                    return view('usuarios.edit', compact('usuario'));
                }
            }
        } catch (Exception $e) {
            alert()->error("Exception Edit Usuario!");
            return redirect()->to(route('login'));
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
    public function update(Request $request, $idUsuario)
    {
        try {
            if (!$this->checkDatabaseConnection()) {
                return view('db_conexion');
            } else {
                $sesion = $this->validarVariablesSesion();

                if (
                    empty($sesion[0]) || is_null($sesion[0]) &&
                    empty($sesion[1]) || is_null($sesion[1]) &&
                    empty($sesion[2]) || is_null($sesion[2]) && !$sesion[3]
                ) {
                    return redirect()->to(route('login'));
                } else {
                    return new UsuarioUpdate();
                }
            }
        } catch (Exception $e) {
            alert()->error("Exception Update Usuario!");
            return redirect()->to(route('login'));
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
    public function destroy($id)
    {
        //
    }

    // ======================================================================
    // ======================================================================

    public function listarProveedores()
    {
        try {
            if (!$this->checkDatabaseConnection()) {
                return view('db_conexion');
            } else {
                $sesion = $this->validarVariablesSesion();

                if (
                    empty($sesion[0]) || is_null($sesion[0]) &&
                    empty($sesion[1]) || is_null($sesion[1]) &&
                    empty($sesion[2]) || is_null($sesion[2]) && !$sesion[3]
                ) {
                    return redirect()->to(route('login'));
                } else {
                    return view('personas.listar_proveedores');
                }
            }
        } catch (Exception $e) {
            alert()->error("Exception Store Usuario!");
            return redirect()->to(route('login'));
        }
    }

    // ======================================================================
    // ======================================================================

    public function listarClientes()
    {
        try {
            if (!$this->checkDatabaseConnection()) {
                return view('db_conexion');
            } else {
                $sesion = $this->validarVariablesSesion();

                if (
                    empty($sesion[0]) || is_null($sesion[0]) &&
                    empty($sesion[1]) || is_null($sesion[1]) &&
                    empty($sesion[2]) || is_null($sesion[2]) && !$sesion[3]
                ) {
                    return redirect()->to(route('login'));
                } else {
                    return view('personas.listar_clientes');
                }
            }
        } catch (Exception $e) {
            alert()->error("Exception Store Usuario!");
            return redirect()->to(route('login'));
        }
    }

    public function queryUsuarioUpdate($idUsuario)
    {
        try {
            $response = $this->clientApi->post($this->baseUri . 'query_usuario_update/' . $idUsuario, ['json' => []]);
            return json_decode($response->getBody()->getContents());
        } catch (Exception $e) {
            alert()->error("Error Exception!");
            return back();
        }
    }

    /**
     * Valida la estructura del correo recibido y consulta una API externa
     * para verificar si el correo ya está registrado.
     *
     * @param Request $request Contiene el email a validar
     * @return \Illuminate\Http\JsonResponse Retorna JSON indicando si el email es válido o ya está en uso
     */
    public function emailValidator(Request $request)
    {
        try {
            $request->validate([
                'email' => [
                    'required',
                    'string',
                    'email:rfc,dns',
                    'max:255'
                ]
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'valido' => false,
                'error' => 'El correo no tiene un formato válido.'
            ], 422);
        }
        try {
            $response = $this->clientApi->post($this->baseUri . 'validar_email', [
                'json' => [
                    'email' => $request->input('email')
                ]
            ]);
            return response()->json(json_decode($response->getBody()->getContents(), true));
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'No se pudo validar el email',
                'valido' => false
            ], 500);
        }
    }

    /**
     * Valida que el campo de identificación sea numérico y dentro de un rango de longitud,
     * luego consulta una API externa para verificar si ya está registrada.
     *
     * @param Request $request Contiene el campo 'identificacion' a validar
     * @return \Illuminate\Http\JsonResponse Retorna JSON indicando si la identificación es válida o ya está registrada
     */
    public function identificationValidator(Request $request)
    {
        try {
            $request->validate([
                'identificacion' => [
                    'required',
                    'string',
                    'regex:/^[0-9]+$/',
                    'min:6',
                    'max:15'
                ]
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'valido' => false,
                'error' => 'La identificación no tiene un formato válido.'
            ], 422);
        }

        try {
            $response = $this->clientApi->post($this->baseUri . 'validar_identificacion', [
                'json' => [
                    'identificacion' => $request->input('identificacion')
                ]
            ]);
            return response()->json(json_decode($response->getBody()->getContents(), true));
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'No se pudo validar la identificación',
                'valido' => false
            ], 500);
        }
    }
}
