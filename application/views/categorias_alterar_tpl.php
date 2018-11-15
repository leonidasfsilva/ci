<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include 'header.php'
?>

<div class="content-wrapper">
    <div class="container-fluid">

            <h3>Alterar categoria</h3>

            <?php echo validation_errors(); ?>

            <form method="post" action="<?=site_url('painel/alteraCategoria/'.$dadosCategoria->idcategoria)?>">
                <div class="form-group">
                    <label for="categoriatitulo">Título da categoria</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-list fa-fw"></i></span>
                        </div>
                    <input type="text" class="form-control" id="categoriatitulo" name="categoriatitulo" value="<?=$dadosCategoria->categoriatitulo?>" autofocus>
                    </div>
                </div>

                <a class="btn btn-outline-danger float-left" href="<?=site_url('/painel')?>" role="button"><i class="fa fa-times fa-fw"></i> Cancelar</a>
                <button type="submit" class="btn btn-outline-success float-right"><i class="fa fa-check fa-fw"></i> Alterar</button>
            </form>
        </div>
</div>
<?php include 'footer.php' ?>
</body>
</html>