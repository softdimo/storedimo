<?php

namespace App\Http\Responsable\inicio_sesion;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use App\Traits\MetodosTrait;

class LoginStore implements Responsable
{
    use MetodosTrait;

    public function toResponse($request)
    {
        $usuario = request('usuario', null);
        $clave = request('clave', null);

        if(!isset($usuario) || empty($usuario) || is_null($usuario) || 
            !isset($clave) || empty($clave) || is_null($clave))
        {
            alert()->error('Error','Usuario y Clave son requeridos!');
            return back();
        }

        // ======================================================
        // ======================================================

        $user = $this->consultarUsuario($usuario);
      
        if(isset($user) && !empty($user) && !is_null($user) && $user != 'no_user' && $user != 'error_bd') {

            $contarClaveErronea = $user['clave_fallas'];

            if($contarClaveErronea >= 4)
            {
                $this->inactivarUsuario($user['id_usuario']);
            }

            if($user['id_estado'] == 2)
            {
                alert()->error('Error','Usuario ' . $usuario . ' inactivo, por favor contacte al administrador');
                return back();
            }

            // ==================================

            if(Hash::check($clave, $user['clave']))
            {
                $this->crearVariablesSesion($user);
                $this->actualizarClaveFallas($user['id_usuario'], 0);
                // return redirect('usuarios');
                return redirect()->route('usuarios.index');
                
            } else {
                $contarClaveErronea += 1;
                $this->actualizarClaveFallas($user['id_usuario'], $contarClaveErronea);
                alert()->error('Error','Credenciales Inválidas');
                return back();
            }
        } elseif ($user == 'no_user') {
            alert()->error('Error','Este usuario no existe: ' . $usuario);
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
        // Creamos las variables de sesion
        session()->put('id_usuario', $user['id_usuario']);
        session()->put('usuario', $user['usuario']);
        session()->put('id_rol', $user['id_rol']);
        session()->put('sesion_iniciada', true);
    }

    // ======================================================

    private function consultarUsuario($usuario)
    {
        try {
            $baseUri = env('BASE_URI');

            // Realiza la solicitud POST a la API
            $clientApi = new Client(['base_uri' => $baseUri]);

            $response = $clientApi->post($baseUri.'query_usuario', ['json' => ['usuario' => $usuario]]);
            $respuesta = json_decode($response->getBody()->getContents(), true);

            if(isset($respuesta) && !empty($respuesta)) {
                return $respuesta;
            }
        }
        catch (Exception $e)
        {
            DB::connection('mysql')->rollback();
            alert()->error('Error', 'Error Exception');
            return redirect()->to(route('usuarios.index'));
        }
    }

    // ======================================================

    private function inactivarUsuario($idUser)
    {
        try {

            $baseUri = env('BASE_URI');

            // Realiza la solicitud POST a la API
            $clientApi = new Client(['base_uri' => $baseUri]);

            $response = $clientApi->post($baseUri.'inactivar_usuario/'.$idUser, ['json' => []]);
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
                ['json' => ['clave_fallas' => $contador]]
            );
            json_decode($response->getBody()->getContents());

        } catch (Exception $e) {
            alert()->error('Error', 'Error Exception, si el problema persiste, contacte a Soporte.');
            return back();
        }
    }
}