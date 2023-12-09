<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores del formulario.
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $rol = $_POST['rol'];

    // Conectar a la base de datos.
    include("conexiondb.php");
    $con = conectar();

    // Preparar la consulta para actualizar el usuario.
    $stmt = $con->prepare("UPDATE usuarios SET nombre = ?, apellido = ?, email = ?, rol = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $nombre, $apellido, $email, $rol, $id);

    // Ejecutar la consulta y verificar si fue exitosa.
    if ($stmt->execute()) {
        echo "Los datos del usuario han sido actualizados.";
        // Redirigir al usuario a la página de gestión de usuarios.
        header("Location: gestion_usuarios.php?mensaje=UsuarioActualizado");
    } else {
        echo "Error al actualizar los datos: " . $con->error;
    }

    // Cerrar la declaración y la conexión.
    $stmt->close();
    $con->close();
} else {
    echo "Método de solicitud no válido.";
}
?>
``
