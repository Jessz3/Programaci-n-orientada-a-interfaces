<?php

declare(strict_types=1); //Buena práctica PSR-12
namespace App\Escaner;

//Clase para escanear textos (comentarios, mensajes, etc.)
class EscanerTexto implements EscanerInterface
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
            throw new EscanerException("El comentario no puedes estar vacío.");
        }

        //Máximo 500 caracteres
        if (strlen($dato) > 500) {
            throw new EscanerException("El comentario no puede superar los 500 caracteres.");
        }

        return true;
    }
}