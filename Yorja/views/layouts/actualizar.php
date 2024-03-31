<?php require('head.php') ?>

<div class="container my-4 p-3 rounded-3 shadow">
    <div class="row text-center">
        <h1>Actualizar datos de <?php echo $tableSet ?></h1>
    </div>
    <?php 
        $limit;
        $count = 0;
        if($tableSet == 'productos'){
            $limit = 2;
        }else{
            $limit =1;
        }
    ?>
    <form action="">
        <?php 
            for($i = 0; $i < count($dataToSet['col']); $i++):
                if($count < $limit): ?>
                    <input type="hidden" class="form-control text-light" name="<?php echo $dataToSet['col'][$i] ?>" value="<?php echo $dataToSet['row'][0][$i] ?>" required >
        <?php   else:?>
                    <input type="text" class="form-control text-light" name="<?php echo $dataToSet['col'][$i] ?>" value="<?php echo $dataToSet['row'][0][$i] ?>" required >
        <?php   endif; ?>
        <?php
                $count++;
            endfor;
        ?>
        <input type="hidden" name="method" value="setRow" >
        <input type="hidden" name="tableToSet" value="<?php echo $tableSet ?>" >
        <button type="submit" class="btn btn-primary my-3" >Actualizar</button>
    </form>
</div>



<?php require('foot.php');