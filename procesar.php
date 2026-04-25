<?php
 require 'vendor/autoload.php';

use App\Escaner\EscanerNombre;
use App\Escaner\EscanerEmail;
use App\Escaner\EscanerTexto;
use App\Escaner\EscanerException;

$errores = []; //Arreglo para guardar los errores encontrados

try {
    //Limpiar el formulario
    $nombre = EscanerNombre::limpiar($_POST['nombre']);
    $email = EscanerEmail::limpiar($_POST['email']);
    $comentario = EscanerTexto::limpiar($_POST['comentario']);

    //Validar los datos
    EscanerNombre::escanear($nombre);
    EscanerEmail::escanear($email);
    EscanerTexto::escanear($comentario);

} catch (EscanerException $e) {
    $errores[] = $e->getMessage();
}


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

    <?php if (!empty($errores)): ?>
        <ul>
            <?php foreach ($errores as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    
    <br>
    
    <a href="index.html">Volver</a>

</body>
</html>