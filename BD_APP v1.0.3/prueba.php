<?php

// Incluir el archivo TablaModel.php
require_once 'models/TablaModel.php';

// Crear una instancia del modelo
$modelo = new TablaModel();
$datos_estudiante = array(
    'nombre' => 'Juan',
    'edad' => 20,
    // Agrega aquí los otros campos que deseas agregar
);


try {
    // Llamar al método agregarEstudiante con los datos de prueba
    $resultado = $modelo->obtenerNombresColumnas();

    // Verificar si la inserción fue exitosa
    if ($resultado) {
        echo implode(', ', $resultado);
    } else {
        echo "Hubo un error al agregar el estudiante.";
    }
} catch (Exception $e) {
    // Mostrar el mensaje de error si ocurre una excepción
    echo "Error: " . $e->getMessage();
}
