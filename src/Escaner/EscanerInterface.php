<?php

declare(strict_types=1); //Buena práctica PSR-12
namespace App\Escaner;

//Interfaz común para los escáneres
interface EscanerInterface {
    public function limpiar(string $dato): string;
    public function escanear(string $dato): bool;
}

