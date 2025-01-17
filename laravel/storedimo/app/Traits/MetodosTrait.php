<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

trait MetodosTrait
{
    // public function checkDatabaseConnection()
    // public function checkDatabaseConnection($rutaPerfil)
    // {
    //     try {
    //         DB::connection()->getPdo();
    //         // dd('entra verdadero');
    //         // dd($db);
    //          return view($rutaPerfil);
    //     } catch (\Exception $e) {
    //         dd('entra falso'.$e);
    //          return View::make('db_conexion');
    //     }

    //     // try {
    //     //     DB::connection()->getPdo();
    //     //     return true; // Conexión exitosa
    //     // } catch (\Exception $e) {
    //     //     // dd($e->getMessage());
    //     //     return false; // Fallo en la conexión
    //     // }
    // }

    public function checkDatabaseConnection($rutaPerfil)
    {
        try {
            DB::connection()->getPdo();
            dd('entra verdadero'); // Confirma que entra al bloque try
            return view($rutaPerfil);
        } catch (\PDOException $pdoEx) {
            // Captura errores específicos de PDO
            dd('entra falso PDOException: ' . $pdoEx->getMessage());
            return view('db_conexion');
        } catch (\Exception $e) {
            // Captura otros errores
            dd('entra falso Exception: ' . $e->getMessage());
            return view('db_conexion');
        }
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
}
