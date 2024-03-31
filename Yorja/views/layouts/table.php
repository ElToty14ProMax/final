<?php require('head.php'); ?>
<!-- Contenido de la vista a crear a partir de este punto -->
    <div class="container-fluid bg-danger py-1 my-0" ></div>
    <table class=" table table-striped table-dark table-hover" >
        <!-- Inyectando codigo php para logra crear los botones de actualizacion y eliminacion de forma dinamica -->
        <?php
        //creamos las variable que guardaran el nombre de la columna que es clave primaria y un contador para asegurarnos de que solo tomaremos los valores de las claves primarias
            $colName;
            $colValue;
            $count = 0;
            $limit;
            if($table == 'productos'){
                $limit = 2;
            }
            else{
                $limit = 1;
            }
        ?>
        <thead>
            <tr>
        <?php foreach($data['col'] as $col): ?>
            <th> <?php echo $col ?> </th>
            <?php
                if($count < $limit){
                    $colName = $col;
                }
                $count++;
            ?>
        <?php endforeach ?>
            <th>Operaciones de datos</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data['row'] as $row): ?>
                <?php
                    $count = 0;
                    $colValue = null; 
                ?>
                <tr>
                    <?php foreach($row as $dat): ?>
                        <td> <?php echo $dat ?> </td>
                        <?php 
                            if($count < $limit){
                                $colValue = $dat;
                            }
                            $count++;
                        ?>
                    <?php endforeach ?>
                    <td>
                        <a href="index.php?method=viewSetRow&tableSet=<?php echo $table ?>&colName=<?php echo $colName ?>&colValue=<?php echo $colValue ?>" class="btn btn-success">Actualizar</a>
                        <a href="index.php?method=deleteRow&tableSet=<?php echo $table ?>&colName=<?php echo $colName ?>&colValue=<?php echo $colValue ?>" class="btn btn-danger">Borrar</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
<?php require('foot.php');