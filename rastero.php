<?php
// Incluir el archivo de conexión a la base de datos
include 'conexiondb.php';

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $bookingCode = $_POST["bookingCode"];
    $lastName = $_POST["lastName"];

    // Consultar la información de rastreo en la base de datos
    $query = "SELECT * FROM rastreo_equipajes
              JOIN pasajeros ON rastreo_equipajes.pasajero_id = pasajeros.id
              JOIN equipajes ON rastreo_equipajes.equipaje_id = equipajes.id
              WHERE pasajeros.clave_reservacion = '$bookingCode' AND pasajeros.apellido = '$lastName'
              ORDER BY rastreo_equipajes.id DESC
              LIMIT 1";

    $result = mysqli_query($conn, $query);

    if ($result) {
        // Mostrar la información de rastreo
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            echo "<div class='result-section'>";
            echo "<h2>Información de Rastreo</h2>";
            echo "<p>ID de Rastreo: " . $row['id'] . "</p>";
            echo "<p>Estado: " . $row['estado'] . "</p>";
            // Puedes mostrar más información según tus necesidades
            echo "</div>";
        } else {
            echo "<div class='result-section'>";
            echo "<p>No se encontró información de rastreo para los datos proporcionados.</p>";
            echo "</div>";
        }
    } else {
        // Manejar el error de la consulta
        echo "Error en la consulta: " . mysqli_error($conn);
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
}
?>
