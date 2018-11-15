<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include 'header.php'
?>

<div class="container">

    <div class="col-md-6 offset-md-3">

        <h3>Cadastrar nova categoria</h3>

        <?php echo validation_errors(); ?>

        <form method="post" action="<?=site_url('painel/cadastraCategoria')?>">
            <div class="form-group">
                <label for="categoriatitulo">Título da categoria</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-list fa-fw"></i></span>
                    </div>
                    <input type="text" class="form-control" id="categoriatitulo" name="categoriatitulo" placeholder="Informe o título da categoria" autofocus>
                </div>
            </div>

            <a class="btn btn-outline-secondary btn-sm" href="<?=site_url('/painel')?>" role="button"><i class="fa fa-times fa-fw"></i> Cancelar</a>
            <button type="submit" class="btn btn-outline-success btn-sm"><i class="fa fa-check fa-fw"></i> Cadastrar</button>
        </form>
    </div>
</div>
<?php include 'footer.php' ?>
</body>
</html>