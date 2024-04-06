<?php
require_once('config.php');
require_once('TablaController.php');
require_once('TablaModel.php');
require_once('vendor/autoload.php');

$ruta = $_SERVER['REQUEST_URI'];
$controlador = new TablaController();
$controlador->mostrarTabla();

// Verificar si se ha enviado el formulario de importación de Excel
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['excel_file'])) {
    $modelo = new TablaModel();
    $resultado = $modelo->importarExcel($_FILES['excel_file']);

    if ($resultado) {
        echo "Importación exitosa.";
    } else {
        echo "Error al importar el archivo.";
    }
}

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
    $id_estudiante = $_POST['id'];
    $datos_actualizados = array(
        'nombre' => $_POST['nombre'],
        'edad' => $_POST['edad'],
        'provincia' => $_POST['provincia'],
        'correo_electronico' => $_POST['correo_electronico']
    );

    // Actualizar los datos del estudiante en el modelo
    $controlador = new TablaModel();
    $resultado = $controlador->actualizarEstudiante($id_estudiante, $datos_actualizados);

    // Verificar si la actualización fue exitosa
    if ($resultado) {
        // Mostrar un modal de éxito
        echo '<div id="successModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="successModalLabel">Éxito</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      El estudiante fue actualizado correctamente. Vuelva a actualizar la pagina
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                    </div>
                  </div>
                </div>
              </div>';

        // Lanzar el script de JavaScript para mostrar el modal automáticamente
        echo '<script>$("#successModal").modal("show");</script>';
    } else {
        // Mostrar un modal de error
        echo '<div id="errorModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="errorModalLabel">Error</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      Hubo un error al actualizar el estudiante.
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                    </div>
                  </div>
                </div>
              </div>';

        // Lanzar el script de JavaScript para mostrar el modal automáticamente
        echo '<script>$("#errorModal").modal("show");</script>';
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] === 'registrar') {
    // Verificar si ya existe un estudiante con los mismos datos
    $controlador = new TablaModel();
    $estudiante_existente = $controlador->obtenerEstudiantePorDatos($_POST['nombre'], $_POST['correo_electronico']);

    if ($estudiante_existente === true) {
        // No se encontraron estudiantes con los mismos datos, procede con la inserción del nuevo estudiante
        $datos_actualizados = array(
            'nombre' => $_POST['nombre'],
            'edad' => $_POST['edad'],
            'provincia' => $_POST['provincia'],
            'correo_electronico' => $_POST['correo_electronico']
        );

        // Añadir los datos del estudiante en el modelo
        $resultado = $controlador->agregarEstudiante($datos_actualizados);

        // Verificar si la inserción fue exitosa
        if ($resultado) {
            // Mostrar un modal de éxito
            echo '<div id="successModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="successModalLabel">Éxito</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      Estudiante añadido exitosamente. Vuelva a actualizar la pagina
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                    </div>
                  </div>
                </div>
              </div>';

            // Lanzar el script de JavaScript para mostrar el modal automáticamente
            echo '<script>$("#successModal").modal("show");</script>';
        } else {
            // Mostrar un modal de error indicando que ocurrió un problema al agregar el estudiante
            echo '<div id="errorModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="errorModalLabel">Error</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      Hubo un error al agregar el estudiante.
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                    </div>
                  </div>
                </div>
              </div>';

            // Lanzar el script de JavaScript para mostrar el modal automáticamente
            echo '<script>$("#errorModal").modal("show");</script>';
        }
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



