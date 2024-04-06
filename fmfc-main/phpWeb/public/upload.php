<?php
// public/upload.php
require_once '../config/database.php';
require '../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

if (isset($_FILES['excel_file'])) {
    $file = $_FILES['excel_file']['tmp_name'];
    $spreadsheet = IOFactory::load($file);
    $worksheet = $spreadsheet->getActiveSheet();
    $rows = $worksheet->toArray();

    // Utiliza los valores de los encabezados del Excel como nombres de las columnas
    $columnNames = array_values($rows[0]);

    // Asegúrate de que los nombres de las columnas sean válidos para SQL
    $validColumnNames = array_map(function($columnName) {
        // Elimina caracteres no permitidos y asegúrate de que el nombre de la columna sea válido para SQL
        return preg_replace("/[^A-Za-z0-9 ]/", '', utf8_encode($columnName)); // Utiliza utf8_encode
    }, $columnNames);

    // Crea la consulta SQL para crear la tabla
    $columns = implode(', ', array_map(function($columnName, $index) use ($validColumnNames) {
        // Asegúrate de que los nombres de las columnas estén correctamente encapsulados en comillas dobles
        return '"' . $validColumnNames[$index] . '" VARCHAR';
    }, $columnNames, array_keys($columnNames)));
    $sql = "CREATE TABLE IF NOT EXISTS estudiante ($columns)";
    $pdo->exec($sql);

    // Inserta los datos del Excel en la base de datos
    foreach ($rows as $row) {
        $values = implode(', ', array_map(function($value) use ($pdo) {
            // Asegúrate de que los valores estén correctamente escapados y encapsulados en comillas simples
            return $pdo->quote($value);
        }, array_values($row)));

        $columnsString = implode(', ', array_map(function($columnName) {
            return '"' . $columnName . '"';
        }, $validColumnNames));

        $sql = "INSERT INTO estudiante ($columnsString) VALUES ($values)";
        $pdo->exec($sql);
    }
} else {
    echo "No se subió ningún archivo Excel.";
}
?>
