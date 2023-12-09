<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtén los valores del formulario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $rol = $_POST['rol'];

    // Incluye el código para conectar a la base de datos
    include("conexiondb.php");
    $con = conectar();

    // Prepara la consulta SQL para insertar el nuevo usuario
    $stmt = $con->prepare("INSERT INTO usuarios (nombre, apellido, email, rol) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nombre, $apellido, $email, $rol);

    // Ejecuta la consulta y verifica si fue exitosa
    if ($stmt->execute()) {
        echo "Usuario agregado con éxito.";
        header("Location: gestion_usuarios.php?mensaje=UsuarioAgregado");
    } else {
        echo "Error al agregar el usuario: " . $con->error;
    }

    $stmt->close();
    $con->close();
} else {
    echo "Método de solicitud no válido.";
}
?>
