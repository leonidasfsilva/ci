<?php //$this->load->view('header.php'); ?>

<div class="container bg-dark">
    <div class="col-md-4 offset-md-4">
        <div class="card">
            <h5 class="card-header text-uppercase text-center">Cadastre sua nova senha</h5>
            <div class="card-body">
                <span class="lead">Olá, <?= $nome ?>!</span>
                <p class="">Cadastre uma nova senha para sua conta:</p>

                <?php if (isset($erroUpdate) && $erroUpdate == true) { ?>
                    <div class="alert alert-danger alert-dismissible " role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <span class="small">Erro ao atualizar a senha!</span>
                    </div>
                <?php } ?>

                <?php if (isset($senhasIguais_) && $senhasIguais_ == false) { ?>
                    <div class="alert alert-danger alert-dismissible " role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <span class="small">As senhas não correspondem!</span>
                    </div>
                <?php } ?>

                <?php echo validation_errors(); ?>

                <form method="post" action="<?= site_url('redefinirsenha/alterarsenha')?>">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock fa-fw"></i></span>
                            </div>
                            <input type="hidden" id="token" name="token" value="<?= $token ?>" />
                            <input type="hidden" id="id" name="id" value="<?= $id ?>" />
                            <input type="password" class="form-control" id="novasenha" name="novasenha"
                                   placeholder="Nova senha" required autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock fa-fw"></i></span>
                            </div>
                            <input type="password" class="form-control" id="repitasenha" name="repitasenha"
                                   placeholder="Confirme nova senha" required>
                        </div>
                    </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-outline-primary btn-block font-weight-bold">Cadastrar <i class="fa fa-check fa-fw"></i></button>
                <a href="<?=site_url('/login')?>" class="btn btn-outline-secondary btn-block font-weight-bold">Cancelar <i class="fa fa-times fa-fw"></i></a>
            </div>
            </form>
        </div>
    </div>
</div>
<?php $this->load->view('footer.php'); ?>
</body>
</html>

<?php if (isset($senhaAlterada)  && ($senhaAlterada == false)) { ?>
    <script>
        swal({
            position:'top',
            type: 'error',
            title: 'As senhas não correspondem!',
            showConfirmButton: true,
            showCancelButton: false,
            confirmButtonText: '<i class="fa fa-refresh fa-fw"></i> Tentar novamente ',
            cancelButtonText: '<i class="fa fa-times fa-fw"></i> Cancelar ',
        }).then((result) =>
        {
            if (result.value) {

            } else {

            }
        })
    </script>
<?php } ?>