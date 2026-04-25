<?php

namespace App\Escaner;

//Clase para escanear emails
class EscanerEmail implements Escaner
{
    public static function limpiar(string $dato): string 
    {
        //Quitar espacios y etiquetas HTML
        $dato = strip_tags($dato);
        $dato = trim($dato);

        //Convertir a minúsculas (estándar en emails)
        return strtolower($dato);
    }

    public static function escanear(string $dato): bool
    {
        //No puede estar vacío y no puede ser solo espacios
        if (empty(trim($dato))) {
            return false;
        }

        //Validar formato de email
        if (!filter_var($dato, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        return true;
    }
}