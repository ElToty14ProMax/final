<?php
require_once '../models/TablaModel.php';

// Verificar si se ha proporcionado un ID de registro en la URL
if (isset($_GET['id'])) {
    $id_estudiante = $_GET['id'];

    // Obtener los datos del registro correspondiente al ID
    $modelo = new TablaModel();
    $registro = $modelo->obtenerEstudiantePorId($id_estudiante);

    // Verificar si se han obtenido los datos correctamente
    if ($registro) {
        // Obtener las columnas del registro
        $columnas = array_keys($registro);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Registro</title>
</head>

<body>
    <h1>Editar Registro</h1>
    <form method="POST" action="../index.php?id=<?php echo $id_estudiante; ?>">
        <?php foreach ($columnas as $columna) : ?>
            <!-- Mostrar los datos del registro en el formulario -->
            <label for="<?php echo $columna; ?>"><?php echo ucfirst($columna); ?>:</label><br>
            <input type="text" id="<?php echo $columna; ?>" name="<?php echo $columna; ?>" value="<?php echo $registro[$columna]; ?>"><br><br>
        <?php endforeach; ?>
        <input type="hidden" name="id_estudiante" value="<?php echo $id_estudiante; ?>">
        <button type="submit" name="action" value="actualizar">Guardar</button>
    </form>
</body>

</html>

<?php
    } else {
        echo "No se encontró el registro con el ID proporcionado.";
    }
}
