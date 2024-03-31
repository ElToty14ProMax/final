<?php

require_once('models/TablaModel.php');

class TablaController
{
    public function mostrarTabla()
    {
        $modelo = new TablaModel();
        $datos = $modelo->obtenerRegistros();
        $columnas = $datos['columnas'];
        $registros = $datos['registros'];

        require_once('views/tabla_view.php');
    }

    // En el controlador TablaController
    // En la clase TablaController
    public function actualizarEstudiante($id_estudiante)
    {
        // Verificar si se ha proporcionado un ID de estudiante
        if (!empty($id_estudiante)) {
            // Crear una instancia del modelo
            $modelo = new TablaModel();

            try {
                // Llamar al método del modelo para obtener los datos del estudiante por su ID
                $datos_estudiante = $modelo->obtenerEstudiantePorId($id_estudiante);

                // Verificar si se obtuvieron los datos del estudiante correctamente
                if ($datos_estudiante) {
                    // Pasar los datos del estudiante a la vista de actualización
                    require_once 'views/actualizar.php';
                } else {
                    // Mostrar un mensaje de error si no se encontró el estudiante
                    echo "No se encontró el estudiante con ID: $id_estudiante";
                }
            } catch (Exception $e) {
                // Mostrar un mensaje de error si ocurrió una excepción
                echo "Error al obtener los datos del estudiante: " . $e->getMessage();
            }
        } else {
            // Mostrar un mensaje de error si no se proporcionó el ID del estudiante
            echo "Se requiere el ID del estudiante para actualizar.";
        }
    }

    public function procesarActualizacion()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id_estudiante = $_POST['id_estudiante'];
            $datos_actualizados = $_POST;
            unset($datos_actualizados['id_estudiante']); // Eliminar el ID del estudiante del array de datos actualizados

            $modelo = new TablaModel();
            try {
                $actualizacionExitosa = $modelo->actualizarEstudiante($id_estudiante, $datos_actualizados);
                if ($actualizacionExitosa) {
                    // Redirigir al usuario a una página de éxito o mostrar un mensaje de éxito
                    echo "Los datos del estudiante se actualizaron correctamente.";
                } else {
                    // Mostrar un mensaje de error
                    echo "No se pudo actualizar los datos del estudiante.";
                }
            } catch (Exception $e) {
                // Manejar la excepción, por ejemplo, mostrando un mensaje de error
                echo "Error al actualizar los datos del estudiante: " . $e->getMessage();
            }
        }
    }

    public function eliminarEstudiante($id_estudiante) {
        // Verificar si se ha proporcionado un ID de estudiante
        if (!empty($id_estudiante)) {
            // Crear una instancia del modelo
            $modelo = new TablaModel();
    
            try {
                // Llamar al método del modelo para eliminar el estudiante por su ID
                $eliminacionExitosa = $modelo->eliminarEstudiante($id_estudiante);
                if ($eliminacionExitosa) {
                    echo "El estudiante se eliminó correctamente.";
                } else {
                    echo "No se pudo eliminar el estudiante.";
                }
            } catch (Exception $e) {
                // Mostrar un mensaje de error si ocurrió una excepción
                echo "Error al eliminar el estudiante: " . $e->getMessage();
            }
        } else {
            // Mostrar un mensaje de error si no se proporcionó el ID del estudiante
            echo "Se requiere el ID del estudiante para eliminar.";
        }
    }

    public function mostrarFormularioActualizar($id_estudiante) {
        if (!empty($id_estudiante)) {
            // Crear una instancia del modelo
            $modelo = new TablaModel();
    
            try {
                // Llamar al método del modelo para eliminar el estudiante por su ID
                $eliminacionExitosa = $modelo->obtenerEstudiantePorId($id_estudiante);
                if ($eliminacionExitosa) {
                    echo "El estudiante se eliminó correctamente.";
                } else {
                    echo "No se pudo eliminar el estudiante.";
                }
            } catch (Exception $e) {
                // Mostrar un mensaje de error si ocurrió una excepción
                echo "Error al eliminar el estudiante: " . $e->getMessage();
            }
        } else {
            // Mostrar un mensaje de error si no se proporcionó el ID del estudiante
            echo "Se requiere el ID del estudiante para eliminar.";
        }
    }
    
}
