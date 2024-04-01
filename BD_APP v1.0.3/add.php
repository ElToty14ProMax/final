<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargar Archivo Excel</title>
</head>
<body>
    <h2>Cargar Archivo Excel</h2>
    <form method="POST" action="controlador.php" enctype="multipart/form-data">
        <label for="excel_file">Seleccione un archivo Excel:</label><br>
        <input type="file" id="excel_file" name="excel_file" accept=".xlsx, .xls"><br><br>
        <button type="submit" name="submit">Subir Archivo</button>
    </form>
</body>
</html>
