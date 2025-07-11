<?php
include '../conexion.php';
include '../modelos/inventario_m.php';
$accion= isset ($_GET['accion']) ? $_GET['accion']:'';
if ($accion == 'crear') {
    if($_POST['id']){
        editarProducto($conn, $_POST);
    }else{
        crearProducto($conn, $_POST);
    }
}elseif ($accion == 'eliminar') {
    eliminarProducto($conn, $_GET['id']);
}elseif ($accion == 'registro') {
    registrarProducto($conn, $_POST);
} 
header("Location: ../vistas/administrador/inventario.php")
?>