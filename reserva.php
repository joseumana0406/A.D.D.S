<?php
include 'conexiondb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reservaId = $_POST['id'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $usuarioId = $_POST['usuario_id'];
    $vueloId = $_POST['vuelo_id'];
    $asientoId = $_POST['asiento_id'];
    $claseId = $_POST['clase_id'];

    $con = conectar();

    $sql = "INSERT INTO reservas (id, nombre, email, usuario_id, vuelo_id, asiento_id, clase_id) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("iiisss",$reservaId, $nombre, $email, $usuarioId, $vueloId, $asientoId, $claseId);

    if ($stmt->execute()) {
        echo "Reserva realizada con éxito";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $con->close();
}
?>
