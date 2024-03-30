<?php
session_start();

// Configuración de la conexión a la base de datos
$host = "localhost"; 
$dbname = "usuarios";
$user = "postgres"; 
$password = "allfather.456"; 

// Crear conexión
$conn = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);


// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $usuario = $_SESSION['usuario'];
    $nuevoNombre = $_POST["userName"];
    $nuevoEmail = $_POST["userEmail"];

    

    // Consulta SQL para actualizar el usuario
    $sql = "UPDATE users SET nombre = :nuevoNombre, email = :nuevoEmail WHERE username = :usuario";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->bindParam(':nuevoNombre', $nuevoNombre);
    $stmt->bindParam(':nuevoEmail', $nuevoEmail);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Redirigir al usuario a la página de interfaz principal o mostrar un mensaje de éxito
        header("Location: Interfaz Principal.php");
        exit;
    } else {
        // Mostrar mensaje de error
        echo "Error al actualizar los datos.";
    }
}

// Cerrar conexión
$conn = null;
?>
