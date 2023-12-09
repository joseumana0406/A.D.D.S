<?php
include("conexiondb.php");
$con = conectar();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];

    // Desactivar la comprobación de claves foráneas para permitir la eliminación
    mysqli_query($con, 'SET FOREIGN_KEY_CHECKS=0');

    // Iniciar transacción
    mysqli_begin_transaction($con);

    try {
        // Eliminar registros relacionados en otras tablas
        $stmt = $con->prepare("DELETE FROM empleados WHERE usuario_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();

        // Ahora, eliminar el usuario
        $stmt = $con->prepare("DELETE FROM usuarios WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();

        // Si todo fue bien, hacer commit a la transacción
        mysqli_commit($con);
        
        // Volver a activar la comprobación de claves foráneas
        mysqli_query($con, 'SET FOREIGN_KEY_CHECKS=1');

        // Redirigir de vuelta a la página de gestión con un mensaje de éxito
        header("Location: gestion_usuarios.php?mensaje=UsuarioEliminado");
    } catch (mysqli_sql_exception $exception) {
        // Algo fue mal, hacer rollback a la transacción
        mysqli_rollback($con);

        // Volver a activar la comprobación de claves foráneas
        mysqli_query($con, 'SET FOREIGN_KEY_CHECKS=1');

        // Manejar el error
        die("Error al eliminar usuario: " . $exception->getMessage());
    }

    // Cerrar la conexión
    $con->close();
} else {
    die("Solicitud no válida.");
}
?>
