<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contenido de la Tabla</title>
    <!-- Incluir Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Estilos adicionales */
        body {
            padding-top: 70px; /* Espacio para la barra de navegación fija */
            background-color: #6c757d; /* Cambio de color de fondo a gris oscuro */
        }

        .navbar {
            background-color: #343a40; /* Cambio de color de fondo de la barra de navegación a gris oscuro */
        }
        .navbar
        .navbar-brand {
            color: #fff; /* Cambio de color del texto del título a blanco */
        }

        .table-container {
            border-radius: 8px;
            margin-top: 20px;
        }
        .container_search{
            width: 150px;
        }
        

        .custom-table {
            border-radius: auto;
            border: 1px solid #000; /* Cambio de bordes de la tabla a negro y delgado */
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Sombreado */
            background-color: #f8f9fa; /* Color de fondo gris claro */
        }

        .custom-table th,
        .custom-table td {
            border: 1px solid #000; /* Cambio de bordes de las celdas a negro y delgado */
        }

        .btn-group {
            margin-right: 5px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Contenido de la Tabla</a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="nuevo.php" class="btn btn-primary mr-2">Añadir estudiante</a>
                    </li>
                    <li class="nav-item">
                        <button id="exportPdfButton" class="btn btn-primary mr-2">Exportar a PDF</button>
                    </li>
                    <li class="nav-item">
                        <button id="exportJsonButton" class="btn btn-primary mr-2">Exportar a JSON</button>
                    </li> <br>
                    <li class="nav-item">
                        <div class="container_search" >
                            <input type="search" id="searchInput" class="form-control" placeholder="Buscar Estudiante...">
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container table-container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <table class="table table-bordered custom-table">
                    <thead>
                        <tr>
                            <?php foreach ($columnas as $columna) : ?>
                                <th><?php echo $columna; ?></th>
                            <?php endforeach; ?>
                            <th>Acciones</th> <!-- Columna para los botones de acciones -->
                        </tr>
                    </thead>
                    <tbody class="tbody" id="tbody">
                        <?php foreach ($registros as $registro) : ?>
                            <tr>
                                <?php foreach ($columnas as $columna) : ?>
                                    <td><?php echo $registro[$columna]; ?></td>
                                <?php endforeach; ?>
                                <td>
                                    <!-- Botones de acciones -->
                                    <div class="btn-group" role="group" aria-label="Acciones">
                                        <!-- Botón de actualizar -->
                                        <a href="actualizar.php?id=<?php echo $registro['id']; ?>" class="btn btn-warning mr-1">Actualizar</a>
                                        <!-- Botón de eliminar -->
                                        <a href="index.php?action=eliminar&id=<?php echo $registro['id']; ?>" class="btn btn-danger mr-1" onclick="return confirm('¿Estás seguro de que quieres eliminar este estudiante?');">Eliminar</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Incluir Bootstrap JS y jQuery (si es necesario) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#searchInput').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                $('#tbody tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });
    </script>
</body>

</html>
