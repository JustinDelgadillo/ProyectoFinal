<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>ProyectoFinal - Ver Registros</title>
    <link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>
    <h1>Usuarios Registrados</h1>

    <?php
    include 'conexion.php';
    include 'borrar_registro.php';

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["eliminar"])) {
        $usuario_id = $_GET["eliminar"];

        // Llama a la función para eliminar el registro
        eliminarRegistro($conn, $usuario_id);

        echo '<p class="mensaje">Registro eliminado exitosamente</p>';
    }

    // Procesar actualización si se recibe una solicitud POST con el parámetro 'actualizar'
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["actualizar"])) {
        $usuario_id = $_POST["usuario_id"];
        $nuevo_usuario = $_POST["nuevo_usuario"];
        $nueva_contrasena = $_POST["nueva_contrasena"];

        // Actualizar el usuario y/o contraseña en la base de datos
        if (!empty($nueva_contrasena)) {
            // Si se proporciona una nueva contraseña, actualizar tanto el usuario como la contraseña
            $sql_update_usuario = "UPDATE registros SET nombre_usuario='$nuevo_usuario', password='$nueva_contrasena' WHERE id=$usuario_id";
        } else {
            // Si no se proporciona una nueva contraseña, solo actualizar el usuario
            $sql_update_usuario = "UPDATE registros SET nombre_usuario='$nuevo_usuario' WHERE id=$usuario_id";
        }

        if ($conn->query($sql_update_usuario) === TRUE) {
            echo '<p class="mensaje">Usuario actualizado correctamente</p>';
        } else {
            echo '<p class="error">Error al actualizar usuario: ' . $conn->error . '</p>';
        }
    }

    // Obtener registros de la base de datos
    $sql_select_usuarios = "SELECT * FROM registros";
    $result = $conn->query($sql_select_usuarios);

    if ($result->num_rows > 0) {
        echo '<table>';
        echo '<tr><th>ID</th><th>Usuario</th><th>Acciones</th></tr>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row["id"] . '</td>';
            echo '<td>' . $row["nombre_usuario"] . '</td>';
            echo '<td><a href="?eliminar=' . $row["id"] . '">Eliminar</a></td>';
            echo '<td><a href="?actualizar=' . $row["id"] . '">Actualizar</a></td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo '<p class="mensaje">No hay usuarios registrados</p>';
    }

    // Mostrar el formulario de actualización si se recibe una solicitud GET con el parámetro 'actualizar'
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["actualizar"])) {
        $usuario_id = $_GET["actualizar"];

        // Obtener el usuario actual para mostrarlo en el formulario de actualización
        $sql_select_usuario = "SELECT * FROM registros WHERE id=$usuario_id";
        $result_usuario = $conn->query($sql_select_usuario);

        if ($result_usuario->num_rows > 0) {
            $row_usuario = $result_usuario->fetch_assoc();
            $usuario_actual = $row_usuario["nombre_usuario"];

            // Mostrar formulario de actualización
            echo '<form action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '" method="post">';
            echo '<input type="hidden" name="usuario_id" value="' . $usuario_id . '">';
            echo 'Nuevo Usuario: <input type="text" name="nuevo_usuario" value="' . $usuario_actual . '" required>';
            echo 'Nueva Contraseña: <input type="password" name="nueva_contrasena">';
            echo '<input type="submit" name="actualizar" value="Actualizar">';
            echo '</form>';
        }
    }

    $conn->close();
    ?>

    <button onclick="window.location.href='http://justin319041181.rf.gd//index.php'">Regresar al Inicio</button>
</body>
</html>
