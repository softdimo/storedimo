<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use App\Models\Categoria;
use App\Models\Rol;
use App\Models\Estado;
use App\Models\TipoDocumento;

trait MetodosTrait
{
    public function checkDatabaseConnection()
    {
        try {
            DB::connection()->getPdo();
            return true; // Conexión exitosa
        } catch (\Exception $e) {
            return false; // Conexión fallida
        }
    }

    // ======================================

    public function validarVariablesSesion()
    {
        $variablesSesion =[];

        $idUsuario = session('id_usuario');
        array_push($variablesSesion, $idUsuario);

        $usuario = session('usuario');
        array_push($variablesSesion, $usuario);

        $rolUsuario = session('id_rol');
        array_push($variablesSesion, $rolUsuario);

        $sesionIniciada = session('sesion_iniciada');
        array_push($variablesSesion, $sesionIniciada);

        return $variablesSesion;
    }

    // ======================================

    public function quitarCaracteresEspeciales($cadena)
    {
        $no_permitidas = array("á", "é", "í", "ó", "ú", "Á", "É", "Í", "Ó", "Ú", "ñ",
        "À", "Ã", "Ì", "Ò", "Ù", "Ã™", "Ã ","Ã¨", "Ã¬", "Ã²", "Ã¹", "ç", "Ç", "Ã¢",
        "ê", "Ã®", "Ã´", "Ã»", "Ã‚", "ÃŠ", "ÃŽ", "Ã”","Ã›", "ü", "Ã¶", "Ã–", "Ã¯",
        "Ã¤", "«", "Ò", "Ã", "Ã„", "Ã‹", "ñ", "Ñ", "*");

        $permitidas = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U", "n", "N", "A", "E", "I", "O", "U",
                            "a", "e", "i", "o", "u", "c", "C", "a", "e", "i", "o", "u", "A", "E", "I", "O", "U",
                            "u", "o", "O", "i", "a", "e", "U", "I", "A", "E", "n", "N", "");
        return str_replace($no_permitidas, $permitidas, $cadena);
    }

    // ======================================

    public function shareData()
    {
        view()->share('categorias', Categoria::orderBy('categoria','asc')->pluck('categoria', 'id_categoria'));
        view()->share('roles', Rol::orderBy('rol','asc')->pluck('rol', 'id_rol'));
        view()->share('estados', Estado::orderBy('estado','asc')->pluck('estado', 'id_estado'));
        view()->share('tipos_documento', TipoDocumento::orderBy('tipo_documento','asc')->pluck('tipo_documento', 'id_tipo_documento'));
    }
}
