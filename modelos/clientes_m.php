
<?php
function obtenerClientes($conn) {
    $result = mysqli_query($conn, "SELECT * FROM clientes");
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}
function crearClientes($conn, $data) {
    $sql = "INSERT INTO clientes (nombre, celular) VALUES ('{$data['nombre']}','{$data['celular']}')";
    mysqli_query($conn, $sql);
}
function editarClientes($conn, $data) {
   $sql = "UPDATE clientes SET nombre='{$data['nombre']}', celular='{$data['celular']}' WHERE id={$data['id']}";
    mysqli_query($conn, $sql);
}
function eliminarClientes($conn, $id) {
    mysqli_query($conn, "DELETE FROM clientes WHERE id=$id");
}
?>