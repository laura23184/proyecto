<?php
include '../conexion.php';
include '../modelos/ventas_m.php';
$accion= isset ($_GET['accion']) ? $_GET['accion']:'';
if ($accion == 'crear') {
    if($_POST['id']){
        editarVentas($conn, $_POST);
    }else{
        crearVentas($conn, $_POST);
    }
}elseif ($accion == 'eliminar') {
    eliminarVentas($conn, $_GET['id']);
}elseif ($accion == 'registro') {
    registrarVentas($conn, $_POST);
} 
header("Location: ../vistas/administrador/ventas.php")
?>