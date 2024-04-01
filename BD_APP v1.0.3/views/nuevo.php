<?php
require_once '../models/TablaModel.php';

// Obtener los nombres de las columnas de la tabla de estudiantes
$modelo = new TablaModel();
$columnas = $modelo->obtenerNombresColumnas();

// Verificar si se han obtenido los nombres de las columnas correctamente
if ($columnas) {
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Registro</title>
</head>

<body>
    <h1>Añadir Registro</h1>
    <form method="POST" action="../index.php">
        <?php foreach ($columnas as $columna) : ?>
            <!-- Mostrar los nombres de las columnas como etiquetas y campos de texto -->
            <label for="<?php echo $columna; ?>"><?php echo ucfirst($columna); ?>:</label><br>
            <input type="text" id="<?php echo $columna; ?>" name="<?php echo $columna; ?>"><br><br>
        <?php endforeach; ?>
        <button type="submit" name="action" value="registrar">Guardar</button>
    </form>
</body>

</html>

<?php
} else {
    echo "No se pudieron obtener los nombres de las columnas.";
}
?>
