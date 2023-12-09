<?php
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

    if ($result->num_rows > 0) {
        // Salida de datos de cada fila
        while($row = $result->fetch_assoc()) {
            echo "ID: " . $row["id"]. " - Pasajero ID: " . $row["pasajero_id"]. " - Estado: " . $row["estado"]. "<br>";
        }
    } else {
        echo "No se encontraron resultados para el ID de equipaje: $equipajeId";
    }

    // Cerrar la declaración
    $stmt->close();
}

// Cerrar la conexión
$con->close();
?>
