<?php
include 'conexiondb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recogida de datos del formulario
    $numeroVuelo = isset($_POST['id']) ? $_POST['id'] : '';
    $origen = isset($_POST['origen_de_vuelo']) ? $_POST['origen_de_vuelo'] : '';
    $destino = isset($_POST['destino_de_vuelo']) ? $_POST['destino_de_vuelo'] : '';
    $horaSalida = isset($_POST['salida']) ? $_POST['salida'] : '';
    $horaLlegada = isset($_POST['llegada']) ? $_POST['llegada'] : '';
    $rutaId = isset($_POST['ruta_id']) ? $_POST['ruta_id'] : ''; 
    $controlDeTraficoId = isset($_POST['control_de_trafico_id']) ? $_POST['control_de_trafico_id'] : '';
    $aerolineaId = isset($_POST['aerolinea_id']) ? $_POST['aerolinea_id'] : ''; // Nuevo campo

    // Conexión a la base de datos y preparación de la consulta
    $con = conectar();

    $sql = "INSERT INTO vuelos (id, origen_de_vuelo, destino_de_vuelo, salida, llegada, ruta_id, control_de_trafico_id, aerolinea_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    // Asegúrate de que el tipo de dato (s o i) corresponda con el tipo en tu base de datos
    $stmt->bind_param("sssssiii", $numeroVuelo, $origen, $destino, $horaSalida, $horaLlegada, $rutaId, $controlDeTraficoId, $aerolineaId);

    // Ejecución de la consulta
    if ($stmt->execute()) {
        echo "Nuevo vuelo agregado con éxito";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $con->close();
}
?>
