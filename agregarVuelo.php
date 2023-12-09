<?php
include 'conexiondb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numeroVuelo = $_POST['numeroVuelo'];
    $origen = $_POST['origen'];
    $destino = $_POST['destino'];
    $horaSalida = $_POST['horaSalida'];
    $horaLlegada = $_POST['horaLlegada'];

    $con = conectar();

    $sql = "INSERT INTO vuelos (numero, origen, destino, hora_salida, hora_llegada) VALUES (?, ?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sssss", $numeroVuelo, $origen, $destino, $horaSalida, $horaLlegada);

    if ($stmt->execute()) {
        echo "Nuevo vuelo agregado con éxito";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $con->close();
}
?>
