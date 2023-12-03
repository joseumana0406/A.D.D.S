<?php
class Conexion {
    public function Conectar() {
        // Tus definiciones y configuración de conexión
        // ... código existente ...

        // Manejar los datos del formulario si el método es POST
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Realizar la consulta SQL para verificar email y password
            $sql = 'SELECT * FROM SUPER_AIRLINE.NOMBREUSER WHERE email = :email AND password = :password';
            $query = $this->prepare($sql);
            $query->execute(['email' => $email, 'password' => $password]);

            if ($query->rowCount() == 1) {
                // Credenciales correctas, redirigir a rastreo.html
                header('Location: rastreo.html');
                exit;
            } else {
                // Credenciales incorrectas, manejar el error
                echo "Credenciales incorrectas";
            }
        }

        return $this->bd;
    }
}

// Crear una instancia de Conexion y llamar a Conectar
$conex = new Conexion();
$conex->Conectar();
?>
