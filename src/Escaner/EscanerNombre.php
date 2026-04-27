<?php

declare(strict_types=1); //Buena práctica PSR-12
namespace App\Escaner;

//Clase que implementa la interfaz para escanear nombres
class EscanerNombre implements EscanerInterface
{
    public function limpiar(string $dato): string
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

    public function escanear(string $dato): bool
    {
        //Debe tener entre 2 y 100 caracteres
        if (strlen($dato) < 2 || strlen($dato) > 100) {
            throw new EscanerException("El nombre tiene que ser de entre 2 a 100 caracteres.");
        }

        //Solo letras (incluye acentos) y espacios
        if (!preg_match('/^[\p{L} ]+$/u', $dato)) {
            throw new EscanerException ("El nombre solo puede contener letras y espacios.");
        }

        //Evitar que sea solo espacios o vacío
        if (trim($dato) === '') {
            throw new EscanerException("El nombre no puede estar vacío.");
        }

        return true;
    }
}