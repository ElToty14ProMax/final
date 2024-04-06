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
                    <div class="form-group">
                        <label for="nombre" class="label">ID:</label>
                        <input type="text" class="form-control" id="id" name="id" value="<?php echo $registro['id']; ?>" required readonly>
                        <div class="error-message" id="nombreError"></div>
                    </div>

                    <div class="form-group">
                        <label for="nombre" class="label">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $registro['nombre']; ?>" required oninput="capitalizeFirstLetter(this)" pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+" title="Solo se permiten letras">
                        <div class="error-message" id="nombreError"></div>
                    </div>

                    <div class="form-group">
                        <label for="correo_electronico" class="label">Correo:</label>
                        <input type="email" class="form-control" id="correo_electronico" name="correo_electronico" value="<?php echo $registro['correo_electronico']; ?>" required>
                        <div class="error-message" id="correoError"></div>
                    </div>

                    <div class="form-group">
                        <label for="provincia" class="label">Provincia:</label>
                        <select class="form-control" id="provincia" name="provincia" required>
                            <option value="">Seleccionar Provincia</option>
                            <option value="Pinar del Río">Pinar del Río</option>
                            <option value="La Habana">La Habana</option>
                            <option value="Artemisa">Artemisa</option>
                            <option value="Mayabeque">Mayabeque</option>
                            <option value="Villa Clara">Villa Clara</option>
                            <option value="Cienfuegos">Cienfuegos</option>
                            <option value="Sancti Spiritus">Sancti Spiritus</option>
                            <option value="Ciego de Ávila">Ciego de Ávila</option>
                            <option value="Camaguey">Camaguey</option>
                            <option value="Las Tunas">Las Tunas</option>
                            <option value="Holguin">Holguin</option>
                            <option value="Santiago de Cuba">Santiago de Cuba</option>
                            <option value="Granma">Granma</option>
                            <option value="Guantanamo">Guantanamo</option>
                        </select>
                        <div class="error-message" id="provinciaError"></div>
                    </div>
                    <div class="form-group">
                        <label for="edad" class="label">Edad:</label>
                        <input type="number" class="form-control" id="edad" name="edad" value="<?php echo $registro['edad']; ?>" min="18" max="65" required>
                        <div class="error-message" id="edadError"></div>
                    </div>

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
                // Función para capitalizar la primera letra de cada palabra en el campo de nombre
                function capitalizeFirstLetter(input) {
                    input.value = input.value.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                        return letter.toUpperCase();
                    });
                }

                // Función para validar el formulario
                function validateForm() {
                    let isValid = true;
                    let nombreValue = $('#nombre').val();
                    let correoValue = $('#correo_electronico').val();

                    // Limpiar mensajes de error
                    $('.error-message').text('');

                    // Validar nombre
                    if (!/^[A-Za-zñÑáéíóúÁÉÍÓÚ\s]+$/.test(nombreValue)) {
                        $('#nombreError').text('Solo se permiten letras en el nombre');
                        isValid = false;
                    }

                    // Validar correo electrónico
                    if (!/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/.test(correoValue) && correoValue.toLowerCase() !== 'nan') {
                        $('#correoError').text('Ingrese una dirección de correo electrónico válida');
                        isValid = false;
                    }

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


        </body>

        </html>


<?php
    } else {
        echo "No se encontró el registro con el ID proporcionado.";
    }
}
