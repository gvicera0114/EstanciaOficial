<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Tu archivo de estilos personalizado -->
    <link rel="stylesheet" href="Static/css/styles.css">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-lg p-3 mb-5 bg-white rounded" style="width: 24rem;">
            <div class="card-body text-center">
                <img src="Static/img/upemor_logo.png" alt="Upemor Logo" class="img-fluid mb-4" style="width: 100px;">
                <h1 class="h4 mb-3 font-weight-bold ">Bienvenido al sistema de consultorio Upemor</h1>
                <h2 class="h5 text-secondary">Iniciar Sesión</h2>
                
                 <?php
                if (isset($_GET['error']) && $_GET['error'] == 'AccessDenied') {
                    echo '<div class="alert alert-danger" role="alert">Acceso denegado</div>';
                }
                ?>
                <form action="index.php?action=inciarSesion" method="post">
                    <div class="form-group text-left">
                        <label for="username" class="text-danger">Usuario:</label>
                        <input type="text" class="form-control" id="usuario" name="usuario" required>
                    </div>
                    <div class="form-group text-left">
                        <label for="password" class="text-danger">Contraseña:</label>
                        <input type="password" class="form-control" id="contrasenia" name="contrasenia" required>
                    </div>
                    <button type="submit" class="btn btn-danger btn-block">Ingresar</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
