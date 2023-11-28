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
    ?>

