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

                try {
                    if (!$this->validarContrasena($nuevaClave)) {
                        alert()->info('Info', 'La contraseña no cumple con los requisitos de seguridad.');
                        return back();
                    }

                    $response = $this->clientApi->post($this->baseUri.'cambiar_clave/'.$idUsuario, ['json' => [
                        'clave' => $nuevaClave,
                    ]]);
                    $claveCambiada = json_decode($response->getBody()->getContents());
    
                    if(isset($claveCambiada) && !is_null($claveCambiada) && !empty($claveCambiada)) {
                        alert()->success('Bien', 'Clave cambiada satisfactoriamente');
                        return redirect()->to(route('login'));
    
                    } else {
                        alert()->error('Error', 'Error al cambiar la clave, por favor contacte a Soporte.');
                        return redirect()->to(route('cambiar_clave'));
                    }
                }
                catch (Exception $e)
                {
                    alert()->error('Error', 'Error Exception, si el problema persiste, contacte a Soporte.');
                    return back();
                }
            } else {
                alert()->info('Info','Las claves no coinciden!');
                return back();
            }
        } else {
            alert()->error('Error','Nueva Clave es requerida!');
            return back();
        }
    }
    
    // ===================================================================
    // ===================================================================
    // ===================================================================

    private function validarContrasena($nuevaClave)
    {
        // Verifica que la contraseña tenga al menos una letra mayúscula, una letra minúscula, un número y un carácter especial.
        return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/', $nuevaClave);
    }
}
