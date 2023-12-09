<?php
session_start(); // Iniciar la sesión al principio del script

// Verificar si hay resultados en la sesión
if (!isset($_SESSION['resultados'])) {
    die("No hay resultados para mostrar.");
}

$resultados = $_SESSION['resultados'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultados de Rastreo de Equipaje</title>
    <link rel="stylesheet" href="mostrar_resultados.css"> <!-- Enlaza tu archivo CSS aquí -->
</head>
<body>
    <div class="contenedor-resultados">
        <?php
        if (count($resultados) > 0) {
            foreach ($resultados as $row) {
                echo "<p>ID: " . $row["id"] . " - Pasajero ID: " . $row["pasajero_id"] . " - Estado: " . $row["estado"] . "</p>";
            }
        } else {
            echo "<p>No se encontraron resultados.</p>";
        }
        ?>
    </div>
</body>
</html>
