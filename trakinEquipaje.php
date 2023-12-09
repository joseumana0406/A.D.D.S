<?php
session_start(); // Iniciar la sesión al principio del script

// Incluir archivo de conexión a la base de datos
include("conexiondb.php");

// Conectar a la base de datos
$con = conectar();

// Verificar si se ha enviado el ID del equipaje
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['equipaje_id'])) {
    $equipajeId = $_POST['equipaje_id'];

    // Preparar la consulta SQL para evitar inyecciones de SQL
    $stmt = $con->prepare("SELECT * FROM rastreo_equipajes WHERE equipaje_id = ?");
    $stmt->bind_param("i", $equipajeId); // "i" indica que la variable es de tipo entero

    // Ejecutar la consulta
    $stmt->execute();

    // Obtener los resultados
    $result = $stmt->get_result();

    // Almacenar resultados en la sesión
    $_SESSION['resultados'] = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            array_push($_SESSION['resultados'], $row);
        }
    }

    // Cerrar la declaración y la conexión
    $stmt->close();
    $con->close();

    // Redirigir a la página de mostrar resultados
    header("Location: mostrar_resultados.php");
    exit();
}
?>
