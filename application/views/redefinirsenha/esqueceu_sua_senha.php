<?php //$this->load->view('header.php'); ?>

<div class="container bg-dark">
    <div class="col-md-4 offset-md-4">
        <div class="card">
            <h5 class="card-header text-uppercase text-center">Esqueceu sua senha?</h5>
            <div class="card-body">
                <h6 class="lead text-sm-justify mb-4">Informe seu e-mail cadastrado e enviaremos instruções de como alterar sua senha:</h6>
                <?php echo validation_errors(); ?>

                <?php if (isset($alteracao_senha) == true) {?>
                <script>
                    swal(
                        {
                            position: 'top',
                            type: 'success',
                            title: 'E-mail enviado!',
                            html:
                                '<p class="text-left mb-2">Enviamos um e-mail para <strong><?= $email ?></strong> com as instruções para alterar sua senha.' +
                                '                    Verifique sua caixa de entrada ou pasta de <i>spam</i> e siga as instruções de recuperação de senha.</p>',
                            showCancelButton: true,
                            focusConfirm: true,
                            confirmButtonColor: '#05c101',
                            cancelButtonColor: '#ff0005',
                            confirmButtonText:
                                '<i class="fa fa-check fa-fw"></i> Sim, encerrar ',
                            confirmButtonAriaLabel: 'Sim, encerrar',
                            cancelButtonText:
                                '<i class="fa fa-times fa-fw"></i> Não, cancelar ',
                            cancelButtonAriaLabel: 'Não, cancelar',
                        }
                    ).then((result) =>
                    {
                        if (result.value)
                        {
                            swal(
                                {
                                    position: 'top',
                                    type: 'success',
                                    title: 'Você foi desconectado com sucesso!',
                                    text: 'Até logo, <?=$this->session->userdata("administradornome") ?>!',
                                    timer: 2000,
                                    onOpen: () => {
                                        swal.showLoading()
                                    }
                                }
                            ).then((result) =>
                            {
                                if (result.dismiss === swal.DismissReason.timer)
                                {
                                    window.location.replace('<?= site_url("login/sair") ?>');

                                }
                            })
                        }
                    })
                </script>
                    <?php }?>

                <?php if (isset($usuarioInexistente) == true) { ?>
                    <script>
                        swal(
                            {
                                position: 'top',
                                type: 'error',
                                title: 'Conta inexistente!',
                                html:
                                '<p>Ainda não possui uma conta?</p>'+
                                '<p><a href="#" class="font-weight-bold">'+
                                'Solicite o período de teste <i class="fa fa-user-plus"></i></a></p>',
                                showCancelButton: true,
                                showConfirmButton: false,

                                cancelButtonText:
                                    '<i class="fa fa-times fa-fw"></i> Não, obrigado ',
                                cancelButtonAriaLabel: 'Não, cancelar',
                            }
                        ).then((result) =>
                        {
                            if (result.value)
                            {
                                swal(
                                    {
                                        position: 'top',
                                        type: 'success',
                                        title: 'Você foi desconectado com sucesso!',
                                        text: 'Até logo, <?=$this->session->userdata("administradornome") ?>!',
                                        timer: 2000,
                                        onOpen: () => {
                                            swal.showLoading()
                                        }
                                    }
                                ).then((result) =>
                                {
                                    if (result.dismiss === swal.DismissReason.timer)
                                    {
                                        window.location.replace('<?= site_url("login/sair") ?>');

                                    }
                                })
                            }
                        })
                    </script>
                <?php } ?>

                <?php if (isset($tokenInvalido) && $tokenInvalido == true) { ?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <span class="small font-weight-bold">Token inválido ou expirado!</span>
                    </div>
                <?php } ?>

                <form method="post" action="<?= site_url('redefinirsenha/gerartoken') ?>">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text id="basic-addon1"><i class="fa fa-at"></i>
                            </div>
                            <input type="email" class="form-control" id="usuarioemail" name="usuarioemail"
                                   placeholder="E-mail" required autofocus>
                        </div>
                    </div>

                    <?php if (isset($tokenInvalido) && $tokenInvalido == true) { ?>
                        <div class="alert alert-primary" role="alert">
                            <span class="small">Caso seu token esteja expirado, solicite o envio de um novo token.<br/>
                                <a href="<?=site_url('redefinirsenha')?>" class="font-weight-bold">
                                    Solicitar novo token <i class="fa fa-exchange fa-fw"></i></a>
                            </span>
                        </div>
                    <?php } ?>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-outline-primary btn-block font-weight-bold">Enviar <i class="fa fa-send fa-fw"></i></button>
                <a href="<?=site_url('/login')?>" class="btn btn-outline-secondary btn-block font-weight-bold">Cancelar <i class="fa fa-times fa-fw"></i></a>
            </div>
            </form>
        </div>
    </div>
</div>
<?php $this->load->view('footer.php'); ?>
</body>
</html>