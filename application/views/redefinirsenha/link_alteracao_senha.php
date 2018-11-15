<?php //$this->load->view('header.php'); ?>

<div class="container bg-dark">
    <div class="col-md-4 offset-md-4">
        <div class="card">
            <h5 class="card-header text-uppercase text-center">Link para Alterar Senha</h5>
            <div class="card-body">
                <p class="text-sm-justify mb-2">Enviamos um e-mail para <strong><?= $email ?></strong> com as instruções para alterar sua senha.
                    Verifique sua caixa de entrada ou pasta de <i>spam</i> e siga as instruções de recuperação de senha.</p>
                <?php echo validation_errors(); ?>
                <?php if (isset($falha_login) && $falha_login == true) { ?>
                    <div class="alert alert-danger alert-dismissible small" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <i class="fa fa-times fa-lg fa-fw"></i>
                        <strong>Usuário e/ou senha incorretos!</strong>
                    </div>
                <?php } ?>
                <?php if (isset($usuario_inativo) && $usuario_inativo == true) { ?>
                    <div class="alert alert-warning alert-dismissible small" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <i class="fa fa-exclamation fa-lg fa-fw"></i> <strong>Este usuário encontra-se inativo!</strong>
                    </div>
                <?php } ?>
            </div>
            <div class="card-footer">
                <a href="<?=site_url('/recuperarsenha/verificartoken/?token='.$token.'&id='.$id)?>" class="btn btn-outline-primary btn-block font-weight-bold">Alterar senha <i class="fa fa-refresh fa-fw"></i></a>
            </div>
            </form>
        </div>
    </div>
</div>
<?php $this->load->view('footer.php'); ?>
</body>
</html>