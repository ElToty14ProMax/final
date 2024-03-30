<!DOCTYPE html>
<html>
<head>
    <title>Tabla</title>
</head>
<body>
    <h1>Contenido de la Tabla</h1>
    <table>
        <thead>
            <tr>
                <?php foreach ($columnas as $columna): ?>
                    <th><?php echo $columna; ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($registros as $registro): ?>
                <tr>
                    <?php foreach ($registro as $valor): ?>
                        <td><?php echo $valor; ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
