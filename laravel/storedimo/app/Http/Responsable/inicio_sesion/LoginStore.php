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

        if(!isset($usuario) || empty($usuario) || is_null($usuario) || !isset($clave) || empty($clave) || is_null($clave))
        {
            alert()->error('Error','Usuario y Clave son requeridos!');
            return back();
        }

        // ======================================================
        // ======================================================

        $user = $this->consultarUsuario($usuario);
      
        if(isset($user) && !empty($user) && !is_null($user) && $user != 'no_user' && $user != 'error_bd') {

            $contarClaveErronea = $user['clave_fallas'];

            // ==================================

            if($contarClaveErronea >= 4)
            {
                $this->inactivarUsuario($user['id_usuario']);
            }

            // ==================================

            if($user['id_estado'] == 2)
            {
                alert()->error('Error','Usuario ' . $usuario . ' inactivo, por favor contacte al administrador');
                return back();
            }

            // ==================================

            if(Hash::check($clave, $user['clave'])) {
                $this->crearVariablesSesion($user);
                return redirect('usuarios');
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
            $vista = 'admin.index';
            $checkConnection = $this->checkDatabaseConnection($vista);

            if($checkConnection->getName() == "db_conexion") {
                return view('db_conexion');
            } else {
                $this->shareData();
                return view($vista);
            }
        }
    }

    // ==================================================
    // ==================================================
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
    // ======================================================

    private function consultarUsuario($usuario)
    {
        try {
            $baseUri = env('BASE_URI');

            // Realiza la solicitud POST a la API
            $clientApi = new Client([
                'base_uri' => $baseUri. '/usuario_consulta/'.$usuario,
            ]);

            $response = $clientApi->request('GET');
            $res = $response->getBody()->getContents();
            $respuesta = json_decode($res, true );

            if(isset($respuesta) && !empty($respuesta)) {
                return $respuesta;
            }
        }
        catch (Exception $e)
        {
            dd($e);
            DB::connection('mysql')->rollback();
            alert()->error('Error', 'Error Exception');
            return redirect()->to(route('usuarios.index'));
        }
    }

    // ======================================================
    // ======================================================

    private function inactivarUsuario($idUser)
    {
        try {
            $user = Usuario::find($idUser);
            $user->id_estado = 2;
            $user->save();

        } catch (Exception $e)
        {
            dd($e);
            alert()->error('Error', 'Error Exception, si el problema persiste, contacte a Soporte.');
            return back();
        }
    }

    // ======================================================
    // ======================================================

    private function actualizarClaveFallas($usuario_id, $contador)
    {
        try {
            $user = Usuario::find($usuario_id);
            $user->clave_fallas = $contador;
            $user->save();

        } catch (Exception $e) {
            dd($e);
            alert()->error('Error', 'An error has occurred, try again, if the problem persists contact support.');
            return back();
        }
    }
}