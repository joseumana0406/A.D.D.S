<?php
include("conexion2.php"); 
$con = conectar();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores del formulario.
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $lastname = mysqli_real_escape_string($con, $_POST['lastname']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $repeatPassword = mysqli_real_escape_string($con, $_POST['repeat-password']);

    // Verifica si las contraseñas coinciden.
    if ($password !== $repeatPassword) {
        echo "Las contraseñas no coinciden.";
        exit;
    }

    // Aquí deberías hashear la contraseña antes de guardarla. 
    // Por ahora, la usaremos en texto plano por simplicidad (no es recomendable en producción).
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Usar esto en lugar de texto plano.

    // Preparar la consulta SQL.
    $query = "INSERT INTO users (email, name, lastname, password) VALUES ('$email', '$name', '$lastname', '$hashedPassword')";

    // Ejecutar la consulta.
    $result = mysqli_query($con, $query);

    if ($result) {
        echo "Registro exitoso.";
        // Aquí podrías redirigir al usuario a la página de inicio de sesión o a cualquier otra página.
        // header("Location: index.html");
        exit;
    } else {
        echo "Error en el registro: " . mysqli_error($con);
    }
}
?>
