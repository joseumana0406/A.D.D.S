<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Inicio de Sesión - Usuario</title>
<link rel="stylesheet" href="./css/index.css">
</head>
<body>

<div class="main-container">
    <div class="logo-container">
        <img src="./Imagenes/logo.PNG" alt="Logo de la Aerolínea">
    </div>
    <div class="login-container">
        <form class="login-form"  method="post" action="validar_login.php">
        <input type="email" id="email" name="email" placeholder="Ingrese su correo electrónico">
            <input type="password" id="password" name="password" placeholder="Contraseña">
            <button type="submit">Ingresar</button>
            <a href="#" class="forgot-password">¿Olvidaste la contraseña?</a>
            <button type="button" class="create-account">Crea una cuenta</button>
        </form>
    </div>
</div>

</body>
</html> 