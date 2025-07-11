
<?php
function obtenerProducto($conn) {
    $result = mysqli_query($conn, "SELECT producto.*, categoria.nombre AS categoria FROM producto INNER JOIN categoria ON producto.id_categoria=categoria.id;");
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}
function crearProducto($conn, $data) {
    $sql = "INSERT INTO producto (nombre, codigo, precio, stock, id_categoria) VALUES ('{$data['nombre']}','{$data['codigo']}','{$data['precio']}','{$data['stock']}','{$data['id_categoria']}')";
    mysqli_query($conn, $sql);
}
function editarProducto($conn, $data) {
   $sql = "UPDATE producto SET nombre='{$data['nombre']}', codigo='{$data['codigo']}', precio='{$data['precio']}', stock='{$data['stock']}' , id_categoria='{$data['id_categoria']}' WHERE id={$data['id']}";
    mysqli_query($conn, $sql);
}
function eliminarProducto($conn, $id) {
    mysqli_query($conn, "DELETE FROM producto WHERE id=$id");
}
?>