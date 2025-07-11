
<?php
function obtenerCategorias($conn) {
    $result = mysqli_query($conn, "SELECT * FROM categoria");
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}
function crearCategoria($conn, $data) {
    $sql = "INSERT INTO categoria (nombre) VALUES ('{$data['nombre']}')";
    mysqli_query($conn, $sql);
}
function editarCategoria($conn, $data) {
    $sql = "UPDATE categoria SET nombre='{$data['nombre']}' WHERE id={$data['id']}";
    mysqli_query($conn, $sql);
}
function eliminarCategoria($conn, $id) {
    mysqli_query($conn, "DELETE FROM categoria WHERE id=$id");
}
?>