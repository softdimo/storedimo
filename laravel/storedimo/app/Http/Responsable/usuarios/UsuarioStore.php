<?php

namespace App\Http\Responsable\usuarios;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;
use GuzzleHttp\Client;

class UsuarioStore implements Responsable
{
    protected $baseUri;
    protected $clientApi;

    public function __construct()
    {
        $this->baseUri = env('BASE_URI');
        $this->clientApi = new Client(['base_uri' => $this->baseUri]);
    }

    public function toResponse($request)
    {
        $nombreUsuario = request('nombre_usuario', null);
        $apellidoUsuario = request('apellido_usuario', null);
        $identificacion = request('identificacion', null);
        $email = request('email', null);
        $idEstado = 1;
        $idRol = request('id_rol', null);
        
        // Consultamos si ya existe un usuario con la cedula ingresada
        $consultarIdentificacion = $this->consultarId($identificacion);
        
        if(isset($consultarIdentificacion) && !empty($consultarIdentificacion) && !is_null($consultarIdentificacion)) {
            alert()->info('Info', 'Este número de documento ya existe.');
            return back();
        } else {
            // Contruimos el nombre de usuario
            $separarApellidos = explode(" ", $apellidoUsuario);
            $usuario = substr($this->quitarCaracteresEspeciales(trim($nombreUsuario)), 0,1) . trim($this->quitarCaracteresEspeciales($separarApellidos[0]));
            $usuario = preg_replace("/(Ñ|ñ)/", "n", $usuario);
            $usuario = strtolower($usuario);
            $complemento = "";

            while($this->consultaUsuario($usuario.$complemento))
            {
                $complemento++;
            }

            // ===================================================================

            try {
                $peticionUsuarioStore = $this->clientApi->post($this->baseUri.'usuario_store', [
                    'json' => [
                        'nombre_usuario' => $nombreUsuario,
                        'apellido_usuario' => $apellidoUsuario,
                        'identificacion' => $identificacion,
                        'usuario' => $usuario.$complemento,
                        'email' => $email,
                        'id_rol' => $idRol,
                        'id_estado' => $idEstado,
                        'clave' => Hash::make($identificacion),
                        'clave_fallas' => 0,
                    ]
                ]);
                $resUsuarioStore = json_decode($peticionUsuarioStore->getBody()->getContents());

                if(isset($resUsuarioStore) && !empty($resUsuarioStore))
                {
                    return $this->respuestaExito(
                        'Usuario creado satisfactoriamente.'. $usuario.$complemento . ' y la clave es: ' . $identificacion, 'usuarios.index'
                    );
                }
            }
            catch (Exception $e)
            {
                return $this->respuestaException('Exception, contacte a Soporte.' . $e->getMessage());
            }
        }
    }

    // ===================================================================
    // ===================================================================

    private function consultarId($identificacion)
    {
        $queryIdentificacion = $this->clientApi->post($this->baseUri.'query_identificacion', [
            'json' => ['identificacion' => $identificacion]
        ]);
        return json_decode($queryIdentificacion->getBody()->getContents());
    }

    // ===================================================================
    // ===================================================================

    private function consultaUsuario($usuario)
    {
        try {
            $queryUsuario = $this->clientApi->post($this->baseUri.'query_usuario', [
                'json' => ['usuario' => $usuario]
            ]);
            return json_decode($queryUsuario->getBody()->getContents());

        } catch (Exception $e) {
            return $this->respuestaException('Exception, contacte a Soporte.' . $e->getMessage());
        }
    }

    // ===================================================================
    // ===================================================================

    private function quitarCaracteresEspeciales($cadena)
    {
        $no_permitidas = array("á", "é", "í", "ó", "ú", "Á", "É", "Í", "Ó", "Ú", "ñ", "À", "Ã", "Ì", "Ò", "Ù", "Ã™", "Ã ",
                               "Ã¨", "Ã¬", "Ã²", "Ã¹", "ç", "Ç", "Ã¢", "ê", "Ã®", "Ã´", "Ã»", "Ã‚", "ÃŠ", "ÃŽ", "Ã”",
                               "Ã›", "ü", "Ã¶", "Ã–", "Ã¯", "Ã¤", "«", "Ò", "Ã", "Ã„", "Ã‹", "ñ", "Ñ", "*");

        $permitidas = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "n", "N", "A", "E", "I", "O", "U",
                            "a", "e", "i", "o", "u", "c", "C", "a", "e", "i", "o", "u", "A", "E", "I", "O", "U",
                            "u", "o", "O", "i", "a", "e", "U", "I", "A", "E", "n", "N", "");
        return str_replace($no_permitidas, $permitidas, $cadena);
    }

    // ===================================================================
    // ===================================================================

    // Método auxiliar para mensajes de exito
    private function respuestaExito($mensaje, $ruta)
    {
        alert()->success('Exito', $mensaje);
        return redirect()->to(route($ruta));
    }

    // ========================================================

    // Método auxiliar para manejar errores
    private function respuestaError($mensaje, $ruta)
    {
        alert()->error('Error', $mensaje);
        return redirect()->to(route($ruta));
    }

    // ========================================================

    // Método auxiliar para manejar excepciones
    private function respuestaException($mensaje)
    {
        alert()->error('Error', $mensaje);
        return back();
    }

}