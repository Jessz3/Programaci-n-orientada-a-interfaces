<?php

namespace App\Escaner;

//Interfaz común para los escáneres
interface Escaner {
    public static function limpiar(string $dato): string;
    public static function escanear(string $dato): bool;
}

?>