<?php

namespace App\Http\Responsable\categorias;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Categoria;
use GuzzleHttp\Client;

class CategoriaUpdate implements Responsable
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

    public function toResponse($request)
    {
        $idCategoria = request('id_categoria', null);
        $categoria = request('categoria', null);

        // ===================================================================

        $consultaCategoria = $this->consultaCategoria($categoria);

        if(isset($consultaCategoria) && !empty($consultaCategoria) && !is_null($consultaCategoria)) {
            alert()->info('Info', 'Esta categoría ya existe.');
            return back();
        }

        try {
            $peticionCategoriaUpdate = $this->clientApi->put($this->baseUri.'categoria_update/'.$idCategoria, [
                'json' => ['categoria' => $categoria, 'id_audit' => session('id_usuario')]
            ]);
            $respuestaCategoriaUpdate = json_decode($peticionCategoriaUpdate->getBody()->getContents());

            if(isset($respuestaCategoriaUpdate) && !empty($respuestaCategoriaUpdate))
            {
                alert()->success('Proceso Exitoso', 'Categoría editada satisfactoriamente');
                return redirect()->to(route('categorias.index'));

            } else {
                $this->handleError('Error al editar la categoría, por favor contacte a Soporte.');
            }
        }
        catch (Exception $e)
        {
            $this->handleError('Error Exception, contacte a Soporte.' . $e->getMessage());
        }

        return back();
    }

    // Método auxiliar para manejar errores
    private function handleError($message)
    {
        alert()->error('Error', $message);
    }

    // ===================================================================
    // ===================================================================

    public function consultaCategoria($categoria)
    {
        try
        {
            $peticionConsultaCategoria = $this->clientApi->post($this->baseUri.'consulta_categoria', [
                'json' => ['categoria' => $categoria]
            ]);
            return json_decode($peticionConsultaCategoria->getBody()->getContents());
        }
        catch (Exception $e)
        {
            alert()->error('Error', 'Error Exception, inténtelo de nuevo, si el problema persiste, contacte a Soporte.'.$e->getMessage());
            return back();
        }
    }
}
