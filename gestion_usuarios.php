<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestionar Usuarios</title>
    <link rel="stylesheet" href="/css/gestion_usuaios.css"> <!-- Asegúrate de enlazar correctamente tu archivo CSS -->
</head>
<body>
    <h1>Gestión de Usuarios</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            
            <?php
            // Conectar a la base de datos
            include("conexiondb.php");
            $con = conectar();
            
            // Consultar la base de datos para obtener todos los usuarios
            $query = "SELECT id, nombre, apellido, email, rol FROM usuarios";
            $result = mysqli_query($con, $query);
            
            // Comprobar si la consulta tuvo éxito
            if ($result) {
                // Recorrer los resultados y crear la tabla HTML
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['nombre']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['apellido']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['rol']) . "</td>";
                    echo "<td>";
                    // Botones de acción (editar y eliminar)
                    echo "<button class='edit-btn'>Editar</button> ";
                    echo "<button class='delete-btn'>Eliminar</button>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "Error en la consulta: " . mysqli_error($con);
            }
            
            // Cerrar la conexión
            mysqli_close($con);
            ?>
            
        </tbody>
    </table>
</body>
</html>
