<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>ProyectoFinal - Registro de Usuarios</title>
    <link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>
    <h1>REGISTRO DE USUARIOS</h1>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario" required>

        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" required>

        <input type="submit" name="registrar" value="Registrar">
    </form>
</body>
</html>
