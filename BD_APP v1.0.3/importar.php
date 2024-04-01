<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Importar Excel a PostgreSQL</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center mt-5">Importar Excel a PostgreSQL</h1>
                <form action="index.php?action=importar_excel" method="post" enctype="multipart/form-data" class="mt-4">
                    <div class="form-group">
                        <label for="excel_file">Selecciona el archivo Excel</label>
                        <input type="file" name="excel_file" id="excel_file" class="form-control-file" accept=".xlsx,.xls" required>
                    </div>
                    <button href="../index.php?action=importar_excel type="submit" name="action" value="importar_excel"">Importar</button>
                    
                </form>
            </div>
        </div>
    </div>
</body>
</html>
