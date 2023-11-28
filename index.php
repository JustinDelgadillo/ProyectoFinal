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

    <?php
    include 'conexion.php';
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $usuario = $_POST["usuario"];  
        $contrasena = $_POST["contrasena"];

        $sql_insert_usuario = "INSERT INTO registros (nombre_usuario, password) VALUES ('$usuario', '$contrasena')";
        if ($conn->query($sql_insert_usuario) === TRUE) {
            $usuario_id = $conn->insert_id;
            echo '<p class="mensaje">El usuario se ha registrado con éxito</p>';
        } else {
            echo '<p class="error">Lo sentimos, el usuario no ha logrado ser registrado: ' . $conn->error . '</p>';
        }
    }

    $conn->close();
    ?>

   <button onclick="window.location.href='http://justin319041181.rf.gd/mostrar_registros.php'">Mostrar Usuarios Registrados</button>
</body>
</html>