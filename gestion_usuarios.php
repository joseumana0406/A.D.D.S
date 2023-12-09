<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestionar Usuarios</title>
    <link rel="stylesheet" href="/css/gestion_usuarios.css"> <!-- Asegúrate de enlazar correctamente tu archivo CSS -->
</head>
<body>
    <h1>Gestión de Usuarios</h1>

    <!-- Botón para agregar nuevos usuarios -->
    <div style="margin-bottom: 20px;">
        <a href="agregar_usuario.php" class="add-user-btn">Agregar Usuario</a>
        <a href="admin.html" class="admin-back-btn">Volver a Administración</a>
    </div>

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
                    $id = htmlspecialchars($row['id']);
                    $nombre = htmlspecialchars($row['nombre']);
                    $apellido = htmlspecialchars($row['apellido']);
                    $email = htmlspecialchars($row['email']);
                    $rol = htmlspecialchars($row['rol']);
                    echo "<tr>";
                    echo "<td>{$id}</td>";
                    echo "<td>{$nombre}</td>";
                    echo "<td>{$apellido}</td>";
                    echo "<td>{$email}</td>";
                    echo "<td>{$rol}</td>";
                    echo "<td>";
                    // Formulario de acción para editar (esto se actualizará más adelante)
                    echo "<form method='POST' action='editar_usuario.php' style='display: inline;'>";
                    echo "<input type='hidden' name='id' value='{$id}' />";
                    echo "<button type='submit' class='edit-btn'>Editar</button>";
                    echo "</form> ";
                    // Formulario de acción para eliminar
                    echo "<form method='POST' action='eliminar_usuario.php' style='display: inline;'>";
                    echo "<input type='hidden' name='id' value='{$id}' />";
                    echo "<button type='submit' class='delete-btn' onclick='return confirm(\"¿Estás seguro de que quieres eliminar este usuario?\");'>Eliminar</button>";
                    echo "</form>";
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
