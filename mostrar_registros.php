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
        ?>
    

