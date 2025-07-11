
<?php
function obtenerVentas($conn) {
    $result = mysqli_query($conn, "SELECT ventas.*, usuario.nombre AS usuario FROM ventas INNER JOIN usuario ON ventas.id_usuario=usuario.id;");
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}
function crearVentas($conn, $data) {
    session_start();
    $sql = "INSERT INTO ventas (codigo, total, id_usuario) VALUES ('{$data['codigo']}','{$data['total']}','{$_SESSION['id_usuario']}')";
    mysqli_query($conn, $sql);
} 
function editarVentas($conn, $data) {
    session_start();
   $sql = "UPDATE ventas SET  codigo='{$data['codigo']}', total='{$data['total']}', id_usuario='{$_SESSION['id_usuario']}' WHERE id={$data['id']}";
    mysqli_query($conn, $sql);
}
function eliminarVentas($conn, $id) {
    mysqli_query($conn, "DELETE FROM ventas WHERE id=$id");
}
?>