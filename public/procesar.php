<?php
 require __DIR__ . '/../vendor/autoload.php';

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
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<div class="card">
    <h1>Resultado</h1>
    <h2>Resultado del escaneo de datos</h2>

    <?php if (!empty($errores)): ?>
        <ul class="errores">
            <?php foreach ($errores as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <div class="resultado">
            <div class="field">
                <label>Nombre</label>
                <p><?= htmlspecialchars($nombre) ?></p>
            </div>
            <div class="field">
                <label>Email</label>
                <p><?= htmlspecialchars($email) ?></p>
            </div>
            <div class="field">
                <label>Comentario</label>
                <p><?= htmlspecialchars($comentario) ?></p>
            </div>
        </div>
    <?php endif; ?>

    <a href="index.html" class="btn-volver">Volver</a>
</div>

</body>
</html>