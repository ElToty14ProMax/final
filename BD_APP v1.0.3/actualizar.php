<?php
require_once 'TablaModel.php';

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
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Estilos adicionales */
        body {
            background:linear-gradient(35deg,rgb(78,164,172),rgb(76,77,136),rgb(8,8,212));
            padding: 20px;
            

        }

        .container {
            background-color: rgba(91, 135, 165, 0.651);
            color:grey;
            border-radius: 75%;
            width: 300px;
            height: auto;
            padding: 30px;
            border-radius: 8px;
            margin:0 auto;
            margin-top: 40px;
            margin-bottom: 20px;
            box-shadow: 0px 0px 20px 0px rgb(0, 0, 0);
        }
        .label{
            color:black;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .error-message {
            color: red;
            font-size: 0.9em;
            margin-top: 5px;
        }

        .btn-submit {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-center">Editar Registro</h1>
        <form id="editarForm" method="POST" action="index.php?id=<?php echo $id_estudiante; ?>">
            <?php foreach ($columnas as $columna) : ?>
                <!-- Mostrar los datos del registro en el formulario -->
                <div class="form-group">
                    <label for="<?php echo $columna; ?>" class="label"><?php echo ucfirst($columna); ?>:</label>
                    <input type="text" class="form-control" id="<?php echo $columna; ?>" name="<?php echo $columna; ?>" value="<?php echo $registro[$columna]; ?>">
                    <div class="error-message" id="<?php echo $columna; ?>Error"></div>
                </div>
            <?php endforeach; ?>
            <input type="hidden" name="id_estudiante" value="<?php echo $id_estudiante; ?>">
            <button type="submit" name="action" value="actualizar" class="btn btn-primary btn-block btn-submit">Guardar</button>
        </form>
    </div>

    <!-- Bootstrap JS y jQuery (puedes cambiarlo a tu versión local si lo prefieres) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Función para validar el formulario
        function validateForm() {
            let isValid = true;

            // Limpiar mensajes de error
            $('.error-message').text('');

            // Validar cada campo
            <?php foreach ($columnas as $columna) : ?>
                const <?php echo $columna; ?> = $('#<?php echo $columna; ?>').val().trim();
                if (<?php echo $columna; ?> === '') {
                    $('#<?php echo $columna; ?>Error').text('El <?php echo $columna; ?> es obligatorio.');
                    isValid = false;
                }
            <?php endforeach; ?>

            return isValid;
        }

        // Manejar la validación del formulario cuando se envía
        $('#editarForm').submit(function(event) {
            if (!validateForm()) {
                event.preventDefault(); // Evitar el envío del formulario si no es válido
            }
        });
    </script>
</body>

</html>


<?php
    } else {
        echo "No se encontró el registro con el ID proporcionado.";
    }
}
