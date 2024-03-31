<!DOCTYPE html>
<html>

<head>
    <title>Tabla</title>
    <!-- Incluir Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Estilos adicionales */
        body {
            padding: 20px;
        }

        .btn-group {
            margin-right: 5px;
        }
    </style>
</head>

<body>
    <h1>Contenido de la Tabla</h1>
    <!-- Botón para agregar estudiante -->
    <a href="nuevo.php" class="btn btn-primary mb-3">Añadir estudiante</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <?php foreach ($columnas as $columna) : ?>
                    <th><?php echo $columna; ?></th>
                <?php endforeach; ?>
                <th>Acciones</th> <!-- Columna para los botones de acciones -->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($registros as $registro) : ?>
                <tr>
                    <?php foreach ($columnas as $columna) : ?>
                        <td><?php echo $registro[$columna]; ?></td>
                    <?php endforeach; ?>
                    <td>
                        <!-- Botones de acciones -->
                        <div class="btn-group" role="group" aria-label="Acciones">
                            <!-- Botón de actualizar -->
                            <a href="views/actualizar.php?id=<?php echo $registro['id']; ?>" class="btn btn-warning">Actualizar</a>
                            <!-- Botón de eliminar -->
                            <a href="index.php?action=eliminar&id=<?php echo $registro['id']; ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar este estudiante?');">Eliminar</a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <!-- Incluir Bootstrap JS y jQuery (si es necesario) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>