<?php 
include '../conexion.php';
include '../modelos/clientes_m.php';
$accion= isset ($_GET['accion']) ? $_GET['accion']:'';
if ($accion == 'crear') {
    if($_POST['id']){
        editarClientes($conn, $_POST);
    }else{
        crearClientes($conn, $_POST);
    }
}elseif ($accion == 'eliminar') {
    eliminarClientes($conn, $_GET['id']);
}elseif ($accion == 'registro') {
    registrarUsuario($conn, $_POST);
} 
header("Location: ../vistas/administrador/clientes.php")
?>