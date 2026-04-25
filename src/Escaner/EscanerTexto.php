<?php

namespace App\Escaner;

//Clase para escanear textos (comentarios, mensajes, etc.)
class EscanerTexto implements Escaner
{
    public static function limpiar(string $dato): string
    {
        //Quitar etiquetas HTML y scripts
        $dato = strip_tags($dato);

        //Eliminar espacios al inicio y final
        $dato = trim($dato);

        //Normalizar espacios múltiples a uno solo
        $dato = preg_replace('/\s+/', ' ', $dato);

        return $dato;
    }

    public static function escanear(string $dato): bool
    {
        //No puede estar vacío
        if (empty(trim($dato))) {
            return false;
        }

        //Máximo 500 caracteres
        if (strlen($dato) > 500) {
            return false;
        }

        return true;
    }
}