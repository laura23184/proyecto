<?php
$host = 'localhost';
$dbname = 'lu_base';
$username = 'root';
$password = '';

try {
    $conn = new mysqli($host, $username, $password, $dbname);
    
    if ($conn->connect_errno) {
        throw new Exception("Error de conexión: " . $conn->connect_error);
    }
    
    $conn->set_charset("utf8mb4");
    
} catch (Exception $e) {
    error_log($e->getMessage());
    die("Error al conectar con la base de datos. Por favor intente más tarde.");
}
?>