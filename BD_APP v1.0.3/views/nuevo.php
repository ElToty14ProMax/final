<!DOCTYPE html>
<html>
<head>
    <title>Actualizar Estudiante</title>
    <!-- Incluir Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Actualizar Estudiante</h1>
        <?php
        // Verificar si se ha enviado el formulario
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Aquí pondrías la lógica para actualizar el estudiante en la base de datos
            // Recibir datos del formulario y realizar la actualización
            // Ejemplo:
            // $id = $_GET['id'];
            // $identidad = $_POST['identidad'];
            // $nombre = $_POST['nombre'];
            // ...otros campos
            // Actualizar el estudiante en la base de datos según el ID
            // Redirigir a la página principal o mostrar un mensaje de éxito
            // Ejemplo:
            // header("Location: index.php");
            // exit();
        }
        ?>
        <form method="post">
            <!-- Campos del formulario -->
            <div class="form-group">
                <label for="identidad">Identidad:</label>
                <input type="text" class="form-control" id="identidad" name="identidad" required>
            </div>
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="apellidos">Apellidos:</label>
                <input type="text" class="form-control" id="apellidos" name="apellidos" required>
            </div>
            <!-- Agrega más campos según tus necesidades -->
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
    <!-- Incluir Bootstrap JS y jQuery (si es necesario) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
