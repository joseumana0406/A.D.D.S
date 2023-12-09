<?php
include 'conexiondb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $bookingCode = $_POST["bookingCode"];
    $lastName = $_POST["lastName"];

    // Consultar información de la reserva
    $query = "SELECT * FROM reservas
              JOIN pasajeros ON reservas.usuario_id = pasajeros.usuario_id
              WHERE pasajeros.clave_reservacion = '$bookingCode' AND pasajeros.apellido = '$lastName'
              LIMIT 1";

    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Verificar si ya se realizó el check-in
        $checkinQuery = "SELECT * FROM checkin WHERE reserva_id = " . $row['id'];
        $checkinResult = mysqli_query($conn, $checkinQuery);

        if ($checkinResult && mysqli_num_rows($checkinResult) > 0) {
            echo "<p>Ya se ha realizado el check-in para esta reserva.</p>";
        } else {
            // Realizar el check-in
            $checkinInsertQuery = "INSERT INTO checkin (reserva_id, estado, fecha_checkin) VALUES (" . $row['id'] . ", 'Realizado', NOW())";
            $checkinInsertResult = mysqli_query($conn, $checkinInsertQuery);

            if ($checkinInsertResult) {
                echo "<p>Check-in realizado con éxito.</p>";
            } else {
                echo "<p>Error al realizar el check-in.</p>";
            }
        }
    } else {
        echo "<p>No se encontró una reserva para los datos proporcionados.</p>";
    }

    mysqli_close($conn);
}
?>
