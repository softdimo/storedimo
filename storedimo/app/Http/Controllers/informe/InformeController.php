<?php

namespace App\Http\Controllers\informe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InformeCampo;
use App\Models\Informe;
use App\Http\Responsable\Informes\RespuestaInforme;

class InformeController extends Controller
{
    public function informeGerencialUsuarios()
    {
        // if (!Gate::allows('capacitaciones_informe_gerencial'))
        // {
        //     abort(401);
        // }
        $campos = InformeCampo::formulario(1);
        $informe = Informe::where('informe_codigo', 1)->first();    
        return view('informes.informe', compact('campos', 'informe'));
    }

    public function respuesta(Request $request): RespuestaInforme
    {
        return new RespuestaInforme();
    }
}
