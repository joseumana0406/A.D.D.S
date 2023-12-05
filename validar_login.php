<?php
// Incluye el archivo de conexión
include("conexion2.php");
$con = conectar();

// Verifica si hay una petición POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera el email y la contraseña del formulario
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // Comprueba si los campos no están vacíos
    if (empty($email) || empty($password)) {
        die("Email y contraseña son requeridos.");
    }

    // Crea la consulta SQL para buscar el usuario por email
    $query = "SELECT * FROM users WHERE email = '$email'";
    
    // Ejecuta la consulta
    $result = mysqli_query($con, $query);

    // Comprueba si la consulta se ejecutó correctamente
    if ($result) {
        // Obtiene el usuario de la base de datos
        $user = mysqli_fetch_assoc($result);
        
        // Compara la contraseña en texto plano
        if ($user && $user['password'] === $password) {
            // Si la contraseña coincide, el usuario se autentica correctamente
            echo "Usuario autenticado con éxito.";
            // Aquí podrías redirigir al usuario o iniciar una sesión
        } else {
            // Si la contraseña no coincide, muestra un mensaje de error
            echo "Email o contraseña incorrectos.";
        }
    } else {
        // Si hay un error en la consulta, muestra un mensaje de error
        echo "Error en la consulta: " . mysqli_error($con);
    }
} else {
    // Si no hay una petición POST, redirige al formulario de login o muestra un mensaje
    echo "Método de solicitud no válido.";
}
?>
