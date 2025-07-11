




<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>CRUD Notas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif;
            background-color:rgb(243, 190, 243);
            color:rgb(21, 22, 22);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        
        .login-container {
            background-color: rgb(247, 241, 247);
            border: 1px  rgb(255, 254, 255);
            border-radius: 6px;
            padding: 16px;
            width: 308px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        }
        
        .logo {
            text-align: center;
            margin-bottom: 16px;
        }
        
        .form-group {
            margin-bottom: 16px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 600;
        }
        
        input {
            width: 100%;
            padding: 5px 12px;
            font-size: 14px;
            line-height: 20px;
            border: 1px solid #d8dee4;
            border-radius: 6px;
            box-sizing: border-box;
            margin-bottom: 4px;
        }
        
        .forgot-password {
            font-size: 12px;
            float: right;
            text-decoration: none;
            color: #0969da;
        }
        
        .btn {
            width: 100%;
            text-align: center;
            background-color:rgb(250, 209, 252);
            color: white;
            border: none;
            border-radius: 6px;
            padding: 5px 16px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 16px;
            color:rgb(84, 81, 85);
        }
        
        .btn:hover {
            background-color:rgb(253, 143, 253);
        }
        
        .divider {
            border-top: 1px solid #d8dee4;
            margin: 16px 0;
        }
        
        .secondary-options {
            font-size: 14px;
            text-align: center;
            margin: 16px 0;
        }
        
        .secondary-link {
            color: #0969da;
            text-decoration: none;
        }
        
        .footer {
            font-size: 12px;
            text-align: center;
            margin-top: 40px;
            color: #57606a;
            border-top: 1px solid #d8dee4;
            padding-top: 16px;
        }
        
        .footer a {
            color: #0969da;
            text-decoration: none;
            margin: 0 4px;
        }
        .logo-img {
            width: 100px; 
            height: auto;
            border-radius: 50%;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <form action="../controlador/usuarios_c.php?accion=ingresar" method="POST">

        <div class="logo">
            <img src="./asset/imagen/logo.jpg" alt="Logo de la Empresa" class="logo-img">
        </div>
        
        <div class="form-group">
            <label for="usuario">Correo electrónico</label>
            <input type="text" id="usuario" name="usuario">
        </div>
        
        <div class="form-group">
            <label for="clave">Contraseña</label>
            <input type="password" id="clave" name="clave">
            
        </div>
        
        <button type="submit" class="btn">Ingresar</button>
        
       
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"></script>
</body>
</html>