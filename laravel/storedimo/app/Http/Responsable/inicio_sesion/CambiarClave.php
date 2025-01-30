<?php

namespace App\Http\Responsable\inicio_sesion;

use App\Models\Usuario;
use Exception;
use Illuminate\Contracts\Support\Responsable;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class CambiarClave implements Responsable
{
    protected $baseUri;
    protected $clientApi;

    public function __construct()
    {
        $this->baseUri = env('BASE_URI');
        $this->clientApi = new Client(['base_uri' => $this->baseUri]);
    }

    // ===================================================================
    // ===================================================================
    // ===================================================================

    public function toResponse($request)
    {
        // dd($request);
        $idUsuario = request('id_usuario', null);
        $nuevaClave = request('nueva_clave', null);
        $confirmarClave = request('confirmar_clave', null);

        // ======================================================
        // ======================================================

        if(!isset($nuevaClave) || empty($nuevaClave) || is_null($nuevaClave) || !isset($confirmarClave) || empty($confirmarClave) || is_null($confirmarClave))
        {
            alert()->error('Error','Usuario y Clave son requeridos!');
            return back();
        }

        // ======================================================
        // ======================================================

        if(isset($nuevaClave) || !empty($nuevaClave) || !is_null($nuevaClave) && isset($confirmarClave) || !empty($confirmarClave) || !is_null($confirmarClave))
        {
            if ($nuevaClave == $confirmarClave) {


                /* if ($consultarUsuario) { */
                    try {
                        $response = $this->clientApi->post($this->baseUri.'cambiar_clave/'.$idUsuario, ['json' => [
                            'clave' => $nuevaClave,
                        ]]);
                        $claveCambiada = json_decode($response->getBody()->getContents());
                        dd($claveCambiada);
        
                        if(isset($claveCambiada) && !is_null($claveCambiada) && !empty($claveCambiada)) {
                            // alert()->success('Bien', 'Clave cambiada satisfactoriamente');

                            // return redirect()->to(route('login'));
                            return response()->json('success');
        
                        } else {
                            // alert()->error('Error', 'Error al cambiar la clave, por favor contacte a Soporte.');
                            // return redirect()->to(route('cambiar_clave'));
                            return response()->json('error_exception');

                        }
                    }
                    catch (Exception $e)
                    {
                        dd($e);
                        alert()->error('Error', 'Error Exception, si el problema persiste, contacte a Soporte.');
                        return back();
                    }
                /* } else {
                    alert()->info('Info','Verifique usuario o contraseña!');
                    return back();
                } */
            } else {
                alert()->info('Info','Las claves no coinciden!');
                return back();
            }
        } else {
            alert()->error('Error','Nueva Clave es requerida!');
            return back();
        }
    }

    // ==================================================
    // ==================================================
    // ==================================================

    private function consultarUsuarioCambioClave($idUsuario, $clave)
    {
        try {
            $response = $this->clientApi->post($this->baseUri.'usuario_consulta_cambio_clave', ['json' => [
                'usuario' => $usuario,
                'clave' => $clave,
            ]]);
            $respuesta = json_decode($response->getBody()->getContents());

            if(isset($respuesta) && !empty($respuesta)) {
                return $respuesta;
            }
        } catch (Exception $e) {
            dd($e);
            alert()->error('Error', 'Error Exception');
            return redirect()->to(route('cambiar_clave'));
        }
    }
}