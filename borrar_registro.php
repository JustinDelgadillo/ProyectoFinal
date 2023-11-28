<?php
function eliminarRegistro($conn, $usuario_id) {
    $sql_eliminar_usuario = "DELETE FROM registros WHERE id = $usuario_id";
    return $conn->query($sql_eliminar_usuario);
}
?>
