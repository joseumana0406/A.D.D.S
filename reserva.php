<?php
// Incluir el archivo de conexión a la base de datos
include 'conexiondb.php';

// Consultar los usuarios para el desplegable
$usuarios = mysqli_query($con, "SELECT id, CONCAT(nombre, ' ', apellido) AS nombre_completo FROM usuarios");
$asientos = mysqli_query($con, "SELECT id, numero FROM asientos WHERE estado = 'Disponible'");
$clases = mysqli_query($con, "SELECT id, nombre FROM clases");
?>

<!-- Aquí va el HTML anterior... -->

<!-- Luego, dentro del select de usuarios -->
<select id="usuario_id" name="usuario_id" required>
    <?php while($usuario = mysqli_fetch_assoc($usuarios)): ?>
        <option value="<?php echo $usuario['id']; ?>">
            <?php echo $usuario['nombre_completo']; ?>
        </option>
    <?php endwhile; ?>
</select>

<!-- Lo mismo para asientos -->
<select id="asiento_id" name="asiento_id" required>
    <?php while($asiento = mysqli_fetch_assoc($asientos)): ?>
        <option value="<?php echo $asiento['id']; ?>">
            Asiento <?php echo $asiento['numero']; ?>
        </option>
    <?php endwhile; ?>
</select>

<!-- Y lo mismo para clases -->
<select id="clase_id" name="clase_id" required>
    <?php while($clase = mysqli_fetch_assoc($clases)): ?>
        <option value="<?php echo $clase['id']; ?>">
            <?php echo $clase['nombre']; ?>
        </option>
    <?php endwhile; ?>
</select>

<!-- Continúa el HTML... -->
