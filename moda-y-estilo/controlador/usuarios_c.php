<?php 
include '../conexion.php';
include '../modelos/usuarios_m.php';
$accion= isset ($_GET['accion']) ? $_GET['accion']:'';
if ($accion == 'ingresar') {
    loginUsuario($conn, $_POST);
}elseif ($accion == 'salir') {
    salirUsuario();
}elseif ($accion == 'registro') {
    registrarUsuario($conn, $_POST);
} ?>