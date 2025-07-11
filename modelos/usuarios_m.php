<?php
function loginUsuario($conn, $data) {
    session_start();
    $usuario = $data['usuario'];
    $clave = $data['clave'];
    
    $stmt = $conn->prepare("SELECT id, clave, nombre, rol FROM usuario WHERE correo = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();
    
    if ($resultado->num_rows == 1) {
        $row = $resultado->fetch_assoc();
        if (password_verify($clave, $row['clave'])) {
            $_SESSION['id_usuario'] = $row['id'];
            $_SESSION['usuario'] = $usuario;
            $_SESSION['rol'] = $row['rol'];
            $_SESSION['nombre'] = $row['nombre'];
            header("Location: ../vistas/administrador/index.php");
            exit();
        } else {
            echo "Clave incorrecta.";
        }
    } else {
        echo "Usuario no encontrado.";
    }
}

function obtenerUsuario($conn) {
    $result = mysqli_query($conn, "SELECT * FROM usuario");
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

function salirUsuario() {
    session_start();
    session_unset();
    session_destroy();
    header("Location: ../vistas/login.php");
    exit();
}

function registrarUsuario($conn, $data) {
    $hash = password_hash($data['clave'], PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO usuario VALUES (NULL, '".$data['nombresito']."',  '".$data['correo']."',  '".$data['celular']."','$hash', 'usuario')");
    
    if ($stmt->execute()) {
        header("Location: ../vistas/login.php");
        exit();
    } else {
        echo "Error al registrar el usuario: " . $conn->error;
    }
}
?>