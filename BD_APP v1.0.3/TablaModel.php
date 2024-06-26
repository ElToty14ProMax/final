<?php
require_once('config.php');
require_once 'config/database.php';
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

class TablaModel
{
    private $conexion;

    public function __construct()
    {
        try {
            $dsn = "pgsql:host=" . DB_HOST . ";dbname=" . DB_NAME;
            $this->conexion = new PDO($dsn, DB_USER, DB_PASSWORD);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new Exception("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }

    public function obtenerNombresColumnas()
    {
        try {
            // Realizar una consulta SQL para obtener los nombres de las columnas de la tabla 'estudiante'
            $stmt = $this->conexion->query("SELECT column_name FROM information_schema.columns WHERE table_name='estudiante'");
            $columnas = $stmt->fetchAll(PDO::FETCH_COLUMN);
            return $columnas;
        } catch (PDOException $e) {
            throw new Exception("Error al obtener los nombres de las columnas: " . $e->getMessage());
        }
    }

    // Modifica tu función obtenerRegistros en el modelo TablaModel

    public function obtenerRegistros()
    {
        try {
            // Consulta SQL para obtener los registros ordenados por el campo 'id' de forma ascendente
            $stmt = $this->conexion->query("SELECT column_name FROM information_schema.columns WHERE table_name='estudiante'");
            $columnas = $stmt->fetchAll(PDO::FETCH_COLUMN);

            $stmt = $this->conexion->query("SELECT * FROM estudiante ORDER BY id ASC");
            $registros = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return array('columnas' => $columnas, 'registros' => $registros);
        } catch (PDOException $e) {
            throw new Exception("Error en la consulta: " . $e->getMessage());
        }
    }

    public function obtenerEstudiantePorId($id_estudiante)
    {
        try {
            $stmt = $this->conexion->prepare("SELECT * FROM estudiante WHERE id = :id");
            $stmt->bindValue(':id', $id_estudiante);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error al obtener los datos del estudiante: " . $e->getMessage());
        }
    }

    public function actualizarEstudiante($id_estudiante, $datos): bool
    {
        try {
            $consulta = "UPDATE estudiante SET ";
            $columnas = array_keys($datos);
            foreach ($columnas as $columna) {
                $consulta .= "$columna = :$columna, ";
            }
            $consulta = rtrim($consulta, ', ');
            $consulta .= " WHERE id = :id";

            $stmt = $this->conexion->prepare($consulta);

            foreach ($datos as $columna => $valor) {
                $stmt->bindValue(":$columna", $valor);
            }
            $stmt->bindValue(":id", $id_estudiante);

            $stmt->execute();

            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            throw new Exception("Error al actualizar el estudiante: " . $e->getMessage());
        }
    }

    public function agregarEstudiante($datos_estudiante)
    {
        try {
            // Construir la consulta SQL para insertar un nuevo estudiante
            $columnas = implode(', ', array_keys($datos_estudiante));
            $valores = ':' . implode(', :', array_keys($datos_estudiante));

            $consulta = "INSERT INTO estudiante ($columnas) VALUES ($valores)";
            $stmt = $this->conexion->prepare($consulta);

            // Enlazar los valores de los parámetros
            foreach ($datos_estudiante as $columna => $valor) {
                $stmt->bindValue(":$columna", $valor);
            }

            // Ejecutar la consulta
            $stmt->execute();
            // Devolver true si se insertó correctamente, de lo contrario false
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            throw new Exception("Error al agregar un estudiante: " . $e->getMessage());
        }
    }

    public function eliminarEstudiante($id_estudiante): bool
    {
        try {
            $stmt = $this->conexion->prepare("DELETE FROM estudiante WHERE id = :id");
            $stmt->bindValue(':id', $id_estudiante);
            $stmt->execute();

            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            throw new Exception("Error al eliminar el estudiante: " . $e->getMessage());
        }
    }

    public function obtenerEstudiantePorDatos($nombre, $correo)
    {
        try {
            $stmt = $this->conexion->prepare("SELECT COUNT(*) FROM estudiante WHERE nombre = :nombre AND correo_electronico = :correo");
            $stmt->bindValue(':nombre', $nombre);
            $stmt->bindValue(':correo', $correo);
            $stmt->execute();

            $cantidad = $stmt->fetchColumn();

            return $cantidad > 0; // Devuelve true si la cantidad de registros encontrados es mayor a 0, false en caso contrario
        } catch (PDOException $e) {
            throw new Exception("Error al obtener los datos del estudiante: " . $e->getMessage());
        }
    }





    public function importarExcel($file)
    {
        $spreadsheet = IOFactory::load($file);
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->toArray();

        // Utiliza los valores de los encabezados del Excel como nombres de las columnas
        $columnNames = array_values($rows[0]);

        // Asegúrate de que los nombres de las columnas sean válidos para SQL
        $validColumnNames = array_map(function ($columnName) {
            // Elimina caracteres no permitidos y asegúrate de que el nombre de la columna sea válido para SQL
            return preg_replace("/[^A-Za-z0-9 ]/", '', utf8_encode($columnName)); // Utiliza utf8_encode
        }, $columnNames);

        // Crea la consulta SQL para crear la tabla
        $columns = implode(', ', array_map(function ($columnName, $index) use ($validColumnNames) {
            // Asegúrate de que los nombres de las columnas estén correctamente encapsulados en comillas dobles
            return '"' . $validColumnNames[$index] . '" VARCHAR';
        }, $columnNames, array_keys($columnNames)));
        $sql = "CREATE TABLE IF NOT EXISTS estudiante ($columns)";
        $this->conexion->exec($sql);

        // Inserta los datos del Excel en la base de datos
        foreach ($rows as $row) {
            $values = implode(', ', array_map(function ($value) {
                // Asegúrate de que los valores estén correctamente escapados y encapsulados en comillas simples
                return $this->conexion->quote($value);
            }, array_values($row)));

            $columnsString = implode(', ', array_map(function ($columnName) {
                return '"' . $columnName . '"';
            }, $validColumnNames));

            $sql = "INSERT INTO estudiante ($columnsString) VALUES ($values)";
            $this->conexion->exec($sql);
        }
        return true;
    }
}
