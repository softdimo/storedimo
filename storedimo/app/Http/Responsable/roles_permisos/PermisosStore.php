<?php

namespace App\Http\Responsable\roles_permisos;

use Exception;
use Illuminate\Contracts\Support\Responsable;
use GuzzleHttp\Client;

class PermisosStore implements Responsable
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
        try
        {
            dd($request);

        } catch (Exception $e)
        {
            alert()->error("Ha ocurrido un error asignando los permisos!");
            return back();
        }
    }
}
