<?php
session_start(); // Es buena práctica iniciar la sesión al comienzo del archivo.

// Incluye el archivo de conexión
include("conexiondb.php");
$con = conectar();

// Verifica si hay una petición POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera el email y la contraseña del formulario
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Comprueba si los campos no están vacíos
    if (empty($email) || empty($password)) {
        die("Email y contraseña son requeridos.");
    }

    // Crea la consulta SQL para buscar el usuario por email usando sentencias preparadas
    $query = "SELECT id, email, password, rol FROM usuarios WHERE email = ?";

    // Prepara la consulta
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $email);

    // Ejecuta la consulta
    $stmt->execute();
    $result = $stmt->get_result();

    // Comprueba si se encontró algún usuario
    if ($result->num_rows === 1) {
        // Obtiene el usuario de la base de datos
        $user = $result->fetch_assoc();

        // Verifica la contraseña
        if (password_verify($password, $user['password'])) {
            // Si la contraseña coincide, el usuario se autentica correctamente

            // Guardar datos relevantes en la sesión
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_role'] = $user['rol'];

            // Redirige basado en el rol del usuario
            if ($user['rol'] === 'admin') {
                header('Location: admin.html');
                exit;
            } else {
                // Asume que cualquier otro rol es un cliente
                header('Location: principal.html');
                exit;
            }
        } else {
            // Si la contraseña no coincide, muestra un mensaje de error
            echo "Email o contraseña incorrectos.";
        }
    } else {
        // Si no se encuentra el usuario, muestra un mensaje de error
        echo "No se encontró el usuario con el email proporcionado.";
    }

    // Cierra la declaración preparada
    $stmt->close();
} else {
    // Si no hay una petición POST, redirige al formulario de login o muestra un mensaje
    echo "Método de solicitud no válido.";
}

// Cierra la conexión
$con->close();
?>
