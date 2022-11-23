<div class="row">
    <div class="col-md-12 text-right">
        <a href="FrontController.php?controller=nota&action=edit" class="btn btn-outline-primary">Crear nota</a>
        <hr/>
    </div>
    <?php
    if (count($dataToView["data"]) > 0) {
        foreach ($dataToView["data"] as $note) {
            ?>
            <div class="col-md-3">
                <div class="card-body border border-secondary rounded">
                    <h5 class="card-title"><?php echo $note['titulo']; ?></h5>
             
                    <div class="card-text"><?php echo nl2br($note['contenido']); ?></div>
                    <hr class="mt-1"/>
                    <a href="FrontController.php?controller=Nota&action=edit&id=<?php echo $note['id']; ?>" class="btn btn-primary">Editar</a>
                    <a href="FrontController.php?controller=Nota&action=confirmDelete&id=<?php echo $note['id']; ?>" class="btn btn-danger">Eliminar</a>
                </div>
            </div>
            <?php
        }   
    } else {
        ?>
        <div class="alert alert-info">
            Actualmente no existen notas.
        </div>
        <?php
    }
    ?>
</div>