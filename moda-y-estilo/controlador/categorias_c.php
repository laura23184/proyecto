<?php 
include '../conexion.php';
include '../modelos/categorias_m.php';
$accion= isset ($_GET['accion']) ? $_GET['accion']:'';
if ($accion == 'crear') {
    if($_POST['id']){
        editarCategoria($conn, $_POST);
    }else{
        crearCategoria($conn, $_POST);
    }
}elseif ($accion == 'eliminar') {
    eliminarCategoria($conn, $_GET['id']);
}elseif ($accion == 'registro') {
    registrarUsuario($conn, $_POST);
} 
header("Location: ../vistas/administrador/categorias.php")
?>