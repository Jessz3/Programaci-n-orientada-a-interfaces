<?php

namespace App\Escaner;

//Clase para escanear nombres
class EscanerNombre implements Escaner
{
    public static function limpiar(string $dato): string
    {
        //Quitar etiquetas HTML y scripts
        $dato = strip_tags($dato);

        //Eliminar caracteres que no sean letras o espacios
        $dato = preg_replace('/[^\p{L} ]/u', '', $dato);

        //Normalizar espacios y formato
        $dato = trim($dato);
        $dato = preg_replace('/\s+/', ' ', $dato); //Unificar espacios múltiples

        //Primera letra de cada palabra en mayúscula
        return ucwords(strtolower($dato));
    }

    public static function escanear(string $dato): bool
    {
        //Debe tener entre 2 y 100 caracteres
        if (strlen($dato) < 2 || strlen($dato) > 100) {
            return false;
        }

        //Solo letras (incluye acentos) y espacios
        if (!preg_match('/^[\p{L} ]+$/u', $dato)) {
            return false;
        }

        //Evitar que sea solo espacios o vacío
        if (trim($dato) === '') {
            return false;
        }

        return true;
    }
}