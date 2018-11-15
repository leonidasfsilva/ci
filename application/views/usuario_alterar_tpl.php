<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include 'header.php'
?>

<div class="content-wrapper">
    <div class="container-fluid">

            <h3>Alterar usuário</h3>

            <hr/>

            <?php echo validation_errors(); ?>

            <form method="post" action="<?=site_url('usuario/alterausuario/'.$dadosUsuario->idusuario)?>">

                <div class="form-group">
                    <label for="categoriatitulo">Nome do usuário</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-user fa-fw"></i></span>
                        </div>
                        <input value="<?=$dadosUsuario->usuarionome?>" type="text" class="form-control" id="usuarionome" name="usuarionome" placeholder="Informe o nome do usuário" autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label for="categoriatitulo">E-mail</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-at fa-fw"></i></span>
                        </div>
                    <input value="<?=$dadosUsuario->usuarioemail?>" type="email" class="form-control" id="usuarioemail" name="usuarioemail" placeholder="Informe o e-mail do usuário" >
                </div>
                </div>

                <div class="form-group">
                    <label for="categoriatitulo">Categoria</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01"><i class="fa fa-list fa-fw"></i></label>
                        </div>
                    <select class="custom-select" id="idcategoria" name="idcategoria">

                        <?php foreach($categorias->result() as $cat) { ?>
                            <option value="<?=$cat->idcategoria?>"
                                <?php if($cat->idcategoria == $dadosUsuario->categoria_idcategoria){ ?>
                                    selected="selected"
                                <?php } ?>
                            >
                                <?=$cat->categoriatitulo?>
                            </option>
                        <?php } ?>

                    </select>
                    </div>
                </div>
                <a href="<?=site_url('usuario/index/'.$dadosUsuario->categoria_idcategoria) ?>" class="btn btn-outline-danger float-left"><i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>
                <button type="submit" class="btn btn-outline-success float-right"><i class="fa fa-check" aria-hidden="true"></i> Alterar</button>
            </form>


        </div>
    </div>
</div>
<?php include 'footer.php' ?>
</body>
</html>