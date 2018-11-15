<?php //$this->load->view('header.php'); ?>

<div class="container bg-dark">
    <div class="col-md-4 offset-md-4">
        <div class="card">
            <h5 class="card-header text-uppercase text-center">Senha alterada</h5>
            <div class="card-body">
                <?php echo validation_errors(); ?>
                <?php if (isset($alteracaoSenha) && $alteracaoSenha == true) { ?>
                    <div class="alert alert-success" role="alert">
                        <i class="fa fa-check fa-lg fa-fw"></i> <strong>Senha alterada com sucesso!</strong>
                    </div>
                    <div class="alert alert-primary">
                    <p>Sua senha foi alterada com sucesso.<br> Você já pode acessar o sistema normalmente com sua nova senha.</p>
                    </div>
                <?php } else {?>
                    <div class="alert alert-success" role="alert">
                        <i class="fa fa-check fa-lg fa-fw"></i> <strong>Senha alterada com sucesso!</strong>
                    </div>
                    <div class="alert alert-primary">
                        <p>Erro ao alterar a senha!<br> Você pode tentar novamente acessando a página de recuperação.</p>
                    </div>
                <?php } ?>
            </div>
            <div class="card-footer">
                <a href="<?=site_url('/login')?>" class="btn btn-outline-primary btn-block font-weight-bold">Efetuar login <i class="fa fa-sign-in fa-fw"></i></a>
            </div>
            </form>
        </div>
    </div>
</div>
<?php $this->load->view('footer.php'); ?>
</body>
</html>