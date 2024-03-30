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

    // Aquí puedes agregar validación adicional de los datos del formulario

    // Consulta SQL para insertar el nuevo usuario
    $sql = "INSERT INTO users (usuario, password) VALUES (:usuario, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->bindParam(':password', $password);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Redirigir al usuario a la página de inicio de sesión o mostrar un mensaje de éxito
        header("Location: Interfaz Principal.php");
        exit;
    } else {
        // Mostrar mensaje de error
        echo "Error al registrarse.";
    }
}

// Cerrar conexión
$conn = null;
?>
