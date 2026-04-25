<?php
require_once __DIR__ . '/src/Escaner/Escaner.php';
require_once __DIR__ . '/src/Escaner/EscanerNombre.php';
require_once __DIR__ . '/src/Escaner/EscanerEmail.php';
require_once __DIR__ . '/src/Escaner/EscanerTexto.php';

use App\Escaner\EscanerNombre;
use App\Escaner\EscanerEmail;
use App\Escaner\EscanerTexto;

//Limpiar el formulario
$nombre = EscanerNombre::limpiar($_POST['nombre']);
$email = EscanerEmail::limpiar($_POST['email']);
$comentario = EscanerTexto::limpiar($_POST['comentario']);

//Validar los datos
$nombreValido = EscanerNombre::escanear($nombre);
$emailValido = EscanerEmail::escanear($email);
$comentarioValido = EscanerTexto::escanear($comentario);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado</title>
</head>
<body>
    <h2>Resultado del escaneo</h2>
    <p><strong>Nombre:</strong> <?= htmlspecialchars($nombre) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($email) ?></p>
    <p><strong>Comentario:</strong> <?= htmlspecialchars($comentario) ?></p>
    
    <br>
    
    <a href="index.html">Volver</a>

</body>
</html>