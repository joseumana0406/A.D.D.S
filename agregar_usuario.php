<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Usuario</title>
    <link rel="stylesheet" href="/css/gestion_usuarios.css">
</head>
<body>
    <h1>Agregar Usuario</h1>
    <form action="procesar_agregar_usuario.php" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required />
        
        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" required />
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required />
        
        <label for="rol">Rol:</label>
        <select id="rol" name="rol">
            <option value="cliente">Cliente</option>
            <option value="admin">Admin</option>
        </select>
        
        <!-- Aquí puedes añadir campos adicionales si son necesarios -->
        
        <input type="submit" value="Agregar Usuario" />
    </form>
</body>
</html>
