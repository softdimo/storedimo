<?php

namespace App\Http\Responsable\inicio_sesion;

use App\Models\Usuario;
use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;

class RecuperarClaveUpdate implements Responsable
{

    // ===================================================================

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
        $usuIdRecuperarClave = request('id_usuario',null);
        $usuClaveNueva = request('clave_nueva',null);
        $usuclaveNuevaConfirmar = request('clave_nueva_confirmar',null);

        $message = "";

        if ($usuClaveNueva != $usuclaveNuevaConfirmar) {
            $message .= "El campo de nueva clave y Confirmación de clave deben ser iguales.";
        } else {
            try {
                $peticion = $this->clientApi->post($this->baseUri.'cambiar_clave/'.$usuIdRecuperarClave, ['json' => [
                    'clave' => $usuClaveNueva
                ]]);
                $claveUpdate = json_decode($peticion->getBody()->getContents());

                if($claveUpdate) {
                    alert()->success('Exito', 'Clave actualizada correctamente.');
                    return redirect()->to(route('login'));
                } else {
                   $message .= 'Error al actualizar la clave, intente nuevamente, si el problema persiste, contacte a soporte.';
                }
            } catch (Exception $e) {
                $message .= 'Error Exception, intente nuevamente, si el problema persiste, contacte a soporte.';
            }
        }

        alert()->error('error', $message);
        return back();
    }
}
