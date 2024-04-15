<?php

namespace App\Http\Responsable\categorias;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Categoria;
use GuzzleHttp\Client;

class ProductoUpdate implements Responsable
{
    public function toResponse($request)
    {
        $idCategoria = request('id_categoria', null);
        $categoria = request('categoria', null);

        // dd($idCategoria, $categoria);
        
        // Consultamos si ya existe un usuario con la cedula ingresada
        // $consultaCategoria = Categoria::where('categoria', $categoria)->first();
        
        // if(isset($consultaCategoria) && !empty($consultaCategoria) && !is_null($consultaCategoria)) {
        //     alert()->info('Info', 'Esta categoría ya existe.');
        //     return back();
        // } else {

            DB::connection('pgsql')->beginTransaction();

            try {
                // Realiza la solicitud POST a la API
                $clientApi = new Client([
                    'base_uri' => 'http://localhost:8000/api/categoria_update/'.$idCategoria,
                    'headers' => [
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                    ],
                    'body' => json_encode([
                        'categoria' => $categoria,
                    ])
                ]);

                $response = $clientApi->request('PUT');
                $res = $response->getBody()->getContents();
                $respuesta = json_decode($res, true );

                // dd($respuesta);

                if(isset($respuesta) && !empty($respuesta))
                {
                    DB::connection('pgsql')->commit();
                    alert()->success('Proceso Exitoso', 'Categoría editada satisfactoriamente');
                    return redirect()->to(route('categorias.index'));

                } else {
                    DB::connection('pgsql')->rollback();
                    alert()->error('Error', 'Error al editar la categoria, por favor contacte a Soporte.');
                    return redirect()->to(route('categorias.index'));
                }

            } // FIN Try
            catch (Exception $e)
            {
                dd($e);
                DB::connection('pgsql')->rollback();
                alert()->error('Error', 'Error editando categoria, si el problema persiste, contacte a Soporte.');
                return back();
            }
        // } // FIN else
    }

    // ===================================================================
    // ===================================================================

    // private function consultarCategoria($categoria)
    // {
    //     try
    //     {
    //         $usuario = Usuario::where('usuario', $usuario)->first();
    //         return $usuario;

    //     }
    //     catch (Exception $e)
    //     {
    //         alert()->error('Error', 'Error, inténtelo de nuevo, si el problema persiste, contacte a Soporte.');
    //         return back();
    //     }
    // }

    // ===================================================================
    // ===================================================================


}
