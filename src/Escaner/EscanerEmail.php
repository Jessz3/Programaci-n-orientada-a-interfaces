<?php

declare(strict_types=1); //Buena práctica PSR-12
namespace App\Escaner;

//Clase con métodos estáticos para escanear emails
class EscanerEmail
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
            throw new EscanerException("El correo no puede estar vacío.");
        }

        //Validar formato de email
        if (!filter_var($dato, FILTER_VALIDATE_EMAIL)) {
            throw new EscanerException("El formato de correo no es válido. (debe incluir @)");
        }

        return true;
    }
}