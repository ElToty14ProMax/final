<?php
// Configuración de la conexión a la base de datos
$host = "localhost"; // Cambia esto por tu host de la base de datos
$dbname = "usuarios"; // Cambia esto por el nombre de tu base de datos
$user = "postgres"; // Cambia esto por tu usuario de la base de datos
$password = "Toty*020314"; // Cambia esto por tu contraseña de la base de datos

// Crear conexión
$conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);



// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $usuario = $_POST["Usuario"];
    $password = $_POST["Password"];

    // Consulta SQL para buscar el usuario
    $sql = "SELECT * FROM users WHERE usuario = :usuario AND password = :password";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    // Verificar si el usuario existe
    if ($stmt->rowCount() > 0) {
        // Iniciar sesión
        session_start();
        $_SESSION["usuario"] = $usuario;
        // Redirigir al usuario a la página principal
        header("Location: Interfaz Principal.php");
        exit;
    } else {
        // Mostrar mensaje de error
        echo "Usuario o contraseña incorrectos.";
    }
}

// Cerrar conexión
$conn = null;
?>
