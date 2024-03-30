<?php
require_once('config.php');

class TablaModel {
    public function obtenerRegistros() {
        try {
            $conexion = new PDO("pgsql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Consulta para obtener los nombres de las columnas
            $stmt = $conexion->query("SELECT column_name FROM information_schema.columns WHERE table_name='estudiante'");
            $columnas = $stmt->fetchAll(PDO::FETCH_COLUMN);

            // Consulta para obtener los registros
            $stmt = $conexion->query("SELECT * FROM estudiante");
            $registros = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return array('columnas' => $columnas, 'registros' => $registros);
        } catch(PDOException $e) {
            echo "Error en la consulta: " . $e->getMessage();
            exit();
        }
    }
}
?>
