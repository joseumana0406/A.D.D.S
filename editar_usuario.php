<?php
// Comprobar si se ha pasado un ID.
if (isset($_POST['id'])) {
    $userId = $_POST['id'];

    // Aquí incluirías el código para conectar a la base de datos.
    include("conexiondb.php");
    $con = conectar();

    // Obtener los datos del usuario específico.
    $stmt = $con->prepare("SELECT id, nombre, apellido, email, rol FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
    } else {
        die("Usuario no encontrado.");
    }

    // Cerrar conexión
    $stmt->close();
    $con->close();
} else {
    die("Solicitud no válida.");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="/css/editar_usuario.css"> <!-- Asegúrate de enlazar correctamente tu archivo CSS -->
</head>
<body>
    <h1>Editar Usuario</h1>
    <form action="procesar_edicion_usuario.php" method="post">
        <input type="hidden" name="id" value="<?php echo $user['id']; ?>" />
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo $user['nombre']; ?>" required />
        
        <label for="apellido">Apellido:</label>
        <input type="text" id="apellido" name="apellido" value="<?php echo $user['apellido']; ?>" required />
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required />
        
        <label for="rol">Rol:</label>
        <select id="rol" name="rol">
            <option value="cliente" <?php echo $user['rol'] == 'cliente' ? 'selected' : ''; ?>>Cliente</option>
            <option value="admin" <?php echo $user['rol'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
        </select>
        
        <input type="submit" value="Guardar Cambios" />
    </form>
</body>
</html>
