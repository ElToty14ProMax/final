<?php

require_once('models/TablaModel.php'); // Asegúrate de incluir el archivo de tu clase modelo

// Crear una instancia del modelo
$modelo = new TablaModel();

try {
    // Obtener todos los registros
    $registros = $modelo->obtenerRegistros();
    echo "Registros obtenidos correctamente: ";
    print_r($registros);

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

?>
