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
            <!-- jQuery UI CSS -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
            <style>
                /* Estilos adicionales */
                body {
                    background: linear-gradient(35deg, rgb(78, 164, 172), rgb(76, 77, 136), rgb(8, 8, 212));
                    padding: 20px;
                }

                .container {
                    background-color: rgba(91, 135, 165, 0.651);
                    color: grey;
                    border-radius: 75%;
                    width: 300px;
                    height: auto;
                    padding: 30px;
                    border-radius: 8px;
                    margin: 0 auto;
                    margin-top: 40px;
                    margin-bottom: 20px;
                    box-shadow: 0px 0px 20px 0px rgb(0, 0, 0);
                }

                .label {
                    color: black;
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
                        <div class="form-group">
                            <label for="<?php echo $columna; ?>" class="label"><?php echo ucfirst($columna); ?>:</label>
                            <?php if ($columna === 'id') : ?>
                                <!-- Si es el campo 'id', mostrarlo como un campo de solo lectura -->
                                <input type="text" class="form-control" id="<?php echo $columna; ?>" name="<?php echo $columna; ?>" value="<?php echo $registro[$columna]; ?>" readonly>
                            <?php elseif (strpos($columna, 'fecha') !== false) : ?>
                                <input type="date" class="form-control datepicker" id="<?php echo $columna; ?>" name="<?php echo $columna; ?>" value="<?php echo $registro[$columna]; ?>" required>
                            <?php else : ?>
                                <input type="text" class="form-control" id="<?php echo $columna; ?>" name="<?php echo $columna; ?>" value="<?php echo $registro[$columna]; ?>" required>
                            <?php endif; ?>
                            <div class="error-message" id="<?php echo $columna; ?>Error"></div>
                        </div>
                    <?php endforeach; ?>
                    <button type="submit" name="action" value="actualizar" class="btn btn-primary btn-block btn-submit">Guardar</button>
                </form>


            </div>

            <!-- Bootstrap JS -->
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
            <!-- jQuery UI -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
            <!-- Moment.js -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

            <!-- Script para inicializar el widget de calendario -->
            <script>
                $(document).ready(function() {
                    // Inicializar el widget de calendario para los campos de fecha
                    $('.datepicker').datepicker({
                        dateFormat: 'yy-mm-dd' // Formato de fecha: año-mes-día
                    });
                });

                // Función para validar el formulario
                function validateForm() {
                    let isValid = true;

                    // Limpiar mensajes de error
                    $('.error-message').text('');

                    // Validar cada campo
                    <?php foreach ($columnas as $columna) : ?>
                        <?php if ($columna === 'identidad') : ?>
                            let identidadValue = $('#<?php echo $columna; ?>').val();
                            if (/^\d{11}$/.test(identidadValue)) {
                                // El campo Identidad contiene solo números y tiene una longitud de 11 caracteres
                            } else {
                                $('#<?php echo $columna; ?>Error').text('El carnet de identidad debe contener exactamente 11 dígitos y solo números');
                                isValid = false;
                            }
                        <?php elseif ($columna === 'teléfono') : ?>
                            let telefonoValue = $('#<?php echo $columna; ?>').val();
                            if (/^\d{8}$/.test(telefonoValue)) {
                                // El campo Teléfono contiene solo números y tiene una longitud de 8 caracteres
                            } else {
                                $('#<?php echo $columna; ?>Error').text('El teléfono debe contener exactamente 8 dígitos y solo números');
                                isValid = false;
                            }
                        <?php elseif ($columna === 'correo_electrónico') : ?>
                            let correoValue = $('#<?php echo $columna; ?>').val();
                            if (/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(correoValue)) {
                                // El campo Correo electrónico es válido
                            } else {
                                $('#<?php echo $columna; ?>Error').text('El correo electrónico debe tener un formato válido');
                                isValid = false;
                            }
                        <?php endif; ?>
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
