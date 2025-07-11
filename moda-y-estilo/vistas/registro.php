<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

</head>
<body>
    <div class="container nt-5">
<form action="../controlador/usuarios_c.php?accion=registro" method="POST">
 <div class="mb-3">
    <label class="form-label">Nombre</label>
    <input type="text" name="nombresito" class="from-control">
 </div>
 <div class="mb-3">
    <label class="form-label">Celular</label>
    <input type="number" name="celular" class="from-control">
 </div> <div class="mb-3">
    <label class="form-label">Correo</label>
    <input type="email" name="correo" class="from-control">
 </div> <div class="mb-3">
    <label class="form-label">clave</label>
    <input type="password" name="clave" class="from-control">
 </div> 
 <button type="submit" class="btn btn-success">Registrar</button>
</form>
<a href="./login.php">ingresar</a>
</div>
</body>
</html>