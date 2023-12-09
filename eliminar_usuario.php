<?php
include("conexiondb.php");
$con = conectar();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Preparar la consulta para evitar inyecciones SQL
    $stmt = $con->prepare("DELETE FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $id);

    // Intentar ejecutar la consulta
    if ($stmt->execute()) {
        // Redirigir de vuelta a la página de gestión con un mensaje de éxito
        header("Location: gestion_usuarios.php?mensaje=UsuarioEliminado");
    } else {
        // Manejar el error
        die("Error al eliminar usuario: " . $con->error);
    }

    $stmt->close();
}

$con->close();
?>
