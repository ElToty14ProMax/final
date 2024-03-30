<?php require('head.php') ?>

<div class="container my-4 p-3 rounded-3 shadow">
    <div class="row text-center">
        <h1>Insertar Nueva fila en <?php echo $row ?> </h1>
    </div>
    <form action="">
        <?php foreach($data_cols as $col): ?>
            <input type="text" class="form-control text-light" placeholder="<?php echo $col ?>" name="<?php echo $col ?>" required >
            <br>
        <?php endforeach; ?>
        <input type="hidden" name="method" value="saveNewRow" >
        <input type="hidden" name="rowToSave" value="<?php echo $row ?>" >
        <button type="submit" class="btn btn-primary" >Guardar</button>
    </form>
</div>

<?php require('foot.php');