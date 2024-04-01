<?php

require_once('controllers/TablaController.php');

$ruta = $_SERVER['REQUEST_URI'];
$controlador = new TablaController();
$controlador->mostrarTabla();


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] === 'registrar') {
    $datos_estudiante = $_POST;
    unset($datos_estudiante['action']);
    $modelo = new TablaModel();

    $resultado = $modelo->agregarEstudiante($datos_estudiante);

    // Verificar si se pudo agregar el estudiante correctamente
    if ($resultado) {
        echo "El estudiante se añadió correctamente.";
    } else {
        echo "Hubo un error al añadir el estudiante.";
    }
} else {
    // Mostrar la tabla de estudiantes si no se envió el formulario
    $controlador->mostrarTabla();
}

// Verificar si se ha enviado el formulario de actualización
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] === 'actualizar') {
    // Obtener los datos del formulario
    $id_estudiante = $_POST['id_estudiante'];
    $datos_actualizados = array(
        'nombre' => $_POST['nombre'],
        'edad' => $_POST['edad'],
        // Agrega aquí los otros campos que deseas actualizar
    );

    // Actualizar los datos del estudiante en el modelo
    $controlador = new TablaModel();
    $resultado = $controlador->actualizarEstudiante($id_estudiante, $datos_actualizados);

    // Verificar si la actualización fue exitosa
    if ($resultado) {
        echo "El estudiante fue actualizado correctamente.";
    } else {
        echo "Hubo un error al actualizar el estudiante.";
    }
}


if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['action']) && $_GET['action'] === 'eliminar' && isset($_GET['id'])) {
    $id_estudiante = $_GET['id'];
    $modelo = new TablaModel();
    $resultado = $modelo->eliminarEstudiante($id_estudiante);

    if ($resultado) {
        $ruta = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        header("Location: $ruta");
        exit(); // Asegúrate de salir del script después de la redirección

    } else {
        echo "Hubo un error al eliminar el estudiante.";
    }
}
