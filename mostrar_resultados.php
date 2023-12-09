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
    <link rel="stylesheet" href="/css/mostrar_resultados.css"> <!-- Enlaza tu archivo CSS aquí -->
    <style>
        /* Añade aquí los estilos del segundo código, especialmente los relacionados con .sidebar */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
        }
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #111;
            overflow-x: hidden;
            padding-top: 20px;
        }
        .sidebar a {
            padding: 6px 8px 6px 16px;
            text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
        }
        .sidebar a:hover {
            color: #f1f1f1;
        }
        .contenedor-resultados {
            margin-left: 250px; /* Ajustar el margen izquierdo para hacer espacio para la barra lateral */
            padding: 1px 16px;
            /* Otros estilos para .contenedor-resultados */
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <a href="reserva.html">Reserva de Vuelos</a>
        <a href="trakinEquipaje.html">Rastreo de equipaje</a>
        <a href="#">Check-in</a>
        <a href="#">Explore</a>
        <a href="index.html">Cerrar Sesión</a>
    </div>

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
