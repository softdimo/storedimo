<?php

namespace App\Http\Responsable\inicio_sesion;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use App\Traits\MetodosTrait;
use App\Helpers\DatabaseConnectionHelper;

class LoginStore implements Responsable
{
    use MetodosTrait;

    public function toResponse($request)
    {
        $email = request('email', null);
        $clave = request('clave', null);

        if(!isset($email) || empty($email) || is_null($email) || !isset($clave) || empty($clave) || is_null($clave))
        {
            alert()->error('Error','Correo y Clave son requeridos!');
            return back();
        }

        // ======================================================
        // ======================================================

        $user = $this->consultarEmail($email);
      
        if(isset($user) && !empty($user) && !is_null($user) && $user != 'error_bd') {

            $contarClaveErronea = $user['clave_fallas'];

            if($contarClaveErronea >= 4)
            {
                $this->inactivarUsuario($user['id_usuario']);
            }

            if($user['id_estado'] == 2)
            {
                alert()->error('Error','Usuario ' . $email . ' inactivo, por favor contacte al administrador');
                return back();
            }

            // ==================================

            // if(Hash::check($clave, $user['clave']))
            // {
            //     $this->crearVariablesSesion($user);
            //     $this->actualizarClaveFallas($user['id_usuario'], 0);
                
            //     return redirect()->route('home.index');
                
            // } else {
            //     $contarClaveErronea += 1;
            //     $this->actualizarClaveFallas($user['id_usuario'], $contarClaveErronea);
            //     alert()->error('Error','Credenciales Inválidas');
            //     return back();
            // }

            // 1. Configurar conexión tenant
            if (isset($user['empresa'])) {
                DatabaseConnectionHelper::configurarConexionTenant($user['empresa']);

                // 2. Buscar el usuario desde la base tenant
                $usuarioTenant = DB::connection('tenant')->table('usuarios')
                    ->where('email', $email)
                    ->first();

                if ($usuarioTenant && Hash::check($clave, $usuarioTenant->clave)) {
                    $this->crearVariablesSesion((array)$usuarioTenant + ['empresa' => $user['empresa']]);
                    $this->actualizarClaveFallas($user['id_usuario'], 0);
                    return redirect()->route('home.index');
                } else {
                    $contarClaveErronea += 1;
                    $this->actualizarClaveFallas($user['id_usuario'], $contarClaveErronea);
                    alert()->error('Error','Credenciales inválidas');
                    return back();
                }
            } else {
                alert()->error('Error','No hay información de empresa asociada.');
                return back();
            }
        } elseif (empty($user) && $user != 'error_bd') {
            alert()->error('Error','Este usuario no existe: ' . $email);
            return back();
        } else {
            if(!$this->checkDatabaseConnection()) {
                return view('db_conexion');
            } else {
                return view('usuarios.index');
            }
        }
    }

    // ==================================================
    
    private function crearVariablesSesion($user)
    {
        // Limpiar sesión previa
        session()->flush();

        // Creamos las variables de sesion
        session()->put('id_usuario', $user['id_usuario']);
        session()->put('usuario', $user['usuario']);
        session()->put('id_rol', $user['id_rol']);
        session()->put('sesion_iniciada', true);

        session()->put('empresa_actual', $user['empresa']); // Guardar toda la info de la empresa

        // Configurar conexión tenant FRESCA
        DatabaseConnectionHelper::configurarConexionTenant($user['empresa']);
    }

    // ======================================================

    private function consultarEmail($email)
    {
        try {
            $baseUri = env('BASE_URI');

            // Realiza la solicitud POST a la API
            $clientApi = new Client(['base_uri' => $baseUri]);

            $response = $clientApi->post($baseUri.'validar_email_login', [
                    'json' => ['email' => $email]
                ]
            );
            return json_decode($response->getBody()->getContents(), true);
        }
        catch (Exception $e)
        {
            DB::connection('mysql')->rollback();
            alert()->error('Error', 'Error Exception');
            return redirect()->route('login');
        }
    }

    // ======================================================

    private function inactivarUsuario($idUser)
    {
        try {

            $baseUri = env('BASE_URI');

            // Realiza la solicitud POST a la API
            $clientApi = new Client(['base_uri' => $baseUri]);

            $response = $clientApi->post($baseUri.'inactivar_usuario/'.$idUser,
                [
                    'json' => ['id_audit' => $idUser]
                ]
            );
            json_decode($response->getBody()->getContents());

        } catch (Exception $e)
        {
            alert()->error('Error', 'Error Exception, si el problema persiste, contacte a Soporte.');
            return back();
        }
    }

    // ======================================================

    private function actualizarClaveFallas($idUsuario, $contador)
    {
        try {

            $baseUri = env('BASE_URI');

            // Realiza la solicitud POST a la API
            $clientApi = new Client(['base_uri' => $baseUri]);

            $response = $clientApi->post($baseUri.'actualizar_clave_fallas/'.$idUsuario,
                [
                    'json' => [
                        'clave_fallas' => $contador,
                        'id_audit' => $idUsuario
                    ]
                ]
            );
            json_decode($response->getBody()->getContents());

        } catch (Exception $e) {
            alert()->error('Error', 'Error Exception, si el problema persiste, contacte a Soporte.');
            return back();
        }
    }
}