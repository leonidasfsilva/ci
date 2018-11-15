<?php $this->load->view('header.php'); ?>

<div class="container bg-dark">
    <div class="col-md-4 offset-md-4">
        <div class="card">
            <h5 class="card-header text-uppercase text-left">MX Code</h5>
            <div class="card-body">
                <h6 class="lead text-sm-justify mb-3">Insira seus dados de cadastro para acessar sua conta:</h6>

                <?php if ($this->session->flashdata('success') != null) { ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <i class="fa fa-check-circle fa-lg fa-fw"></i><span
                                class="small"> <?= $this->session->flashdata('success') ?></span>
                    </div>
                <?php } ?>

                <?php if ($this->session->flashdata('warning') != null) { ?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <i class="fa fa-times-circle fa-lg fa-fw"></i><span
                                class="small"> <?= $this->session->flashdata('warning') ?></span>
                    </div>
                <?php } ?>

                <?php if (isset($usuario_inativo) && $usuario_inativo == true) { ?>
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <span class="small font-weight-bold">Usuário encontra-se inativo!</span>
                    </div>
                <?php } ?>

                <?php echo validation_errors(); ?>

                <form method="post" action="<?= site_url('login/entrar') ?>" id="formLogin">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-user fa-fw"></i></span>
                            </div>
                            <input type="email" class="form-control" id="usuarioemail" name="usuarioemail"
                                   placeholder="E-mail" required autofocus>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock fa-fw"></i></span>
                            </div>
                            <input type="password" class="form-control" id="usuariosenha" name="usuariosenha"
                                   placeholder="Senha" required>
                        </div>
                    </div>
                    <a href="#" onclick="redefinirsenha()" class="badge badge-secondary">Esqueci minha senha</a>
            </div>
            <div class="card-footer">
                <button type="submit" id="btnLogin" class="btn btn-outline-success btn-block font-weight-bold">
                    <span id="labelBtnLogin">Entrar</span>
                     <i class="fa fa-sign-in fa-fw" id="i_static"></i> <i
                            class="fa fa-spinner fa-pulse fa-fw d-none" id="i_spinner"></i>

                </button>
                </form>
            </div>
        </div>

    </div>
</div>
<?php $this->load->view('footer.php'); ?>
</body>
</html>

<script>

    $('#formLogin').submit( function(event) {
            const form = this;

        $('#i_static').addClass('d-none');
        $('#i_spinner').removeClass('d-none');
        $('#labelBtnLogin').html('Entrando...');
        event.preventDefault();

        setTimeout( function () {

            form.submit();
        }, 1000);
    });

</script>

<?php if ($this->session->flashdata('danger') != null) { ?>
    <script>
        swal({
            position: 'top',
            type: 'error',
            title: "<?=$this->session->flashdata('danger')?>",
            html: 'Por favor, tente novamente.\n',
            showConfirmButton: false,
            showCancelButton: false,
            showCloseButton: true,
            focusCancel: true,
            confirmButtonText: '<i class="fa fa-question-circle fa-fw"></i> Esqueci minha senha ',
            cancelButtonText: '<i class="fa fa-times fa-fw"></i> Fechar ',
            footer: '<a href="#" onclick="redefinirsenha()" class="btn btn-outline-secondary btn-sm">Esqueceu sua senha? Clique aqui.</a>',
        }).then((result) => {
            if (result.value) {
                redefinirsenha();
            } else {

            }
        })
    </script>
<?php } ?>

<?php if ($this->session->flashdata('contaBloqueada') != null) { ?>
    <script>

        swal({
            position: 'top',
            type: 'error',
            title: "<?=$this->session->flashdata('contaBloqueada')?>",
            html: 'Por favor, contate o administrador do sistema.',
            showConfirmButton: false,
            showCancelButton: true,
            focusCancel: true,
            cancelButtonText: '<i class="fa fa-times fa-fw"></i> Fechar ',
            confirmButtonText: '<i class="fa fa-commenting fa-fw"></i> Suporte ',
        }).then((result) => {
            if (result.value) {
                window.location.replace('<?= site_url("login/") ?>');
            } else {
                window.location.replace('<?= site_url("login/") ?>');
            }
        })
    </script>
<?php } ?>

<?php if ($this->session->flashdata('contaDesativada') != null) { ?>
    <script>

        swal({
            position: 'top',
            type: 'error',
            title: "<?=$this->session->flashdata('contaDesativada')?>",
            html: 'Por favor, contate o administrador do sistema.',
            showConfirmButton: false,
            showCancelButton: true,
            focusCancel: true,
            cancelButtonText: '<i class="fa fa-times fa-fw"></i> Fechar ',
            confirmButtonText: '<i class="fa fa-commenting fa-fw"></i> Contatar administrador ',
        }).then((result) => {
            if (result.value) {
                window.location.replace('<?= site_url("login/") ?>');
            } else {
                window.location.replace('<?= site_url("login/") ?>');
            }
        })
    </script>
<?php } ?>

<?php if (isset($naoCadastrado) == true) { ?>
    <script>

        swal({
            position: 'top',
            type: 'error',
            title: 'Conta inexistente!',
            html: 'Não encontramos nenhuma conta cadastrada com o email <strong> <?= $email?></strong>.',
            showConfirmButton: true,
            showCancelButton: true,
            reverseButtons: true,
            confirmButtonText: '<i class="fa fa-refresh fa-fw"></i> Tentar de novo ',
            cancelButtonText: '<i class="fa fa-times fa-fw"></i> Cancelar ',
        }).then((result) => {
            if (result.value) {
                window.location.replace('<?= site_url("redefinirsenha/") ?>');
            } else {
                window.location.replace('<?= site_url("login/") ?>');
            }
        })
    </script>
<?php } ?>

<?php if (isset($tokenInvalido) == true) { ?>
    <script>
        swal({
            position: 'top',
            type: 'error',
            title: 'Token inválido!',
            html: 'Você pode solicitar um novo token acessando a página de recuperação de senha.',
            showConfirmButton: true,
            showCancelButton: true,
            reverseButtons: true,
            confirmButtonText: '<i class="fa fa-exchange fa-fw"></i> Solicitar novo token ',
            cancelButtonText: '<i class="fa fa-times fa-fw"></i> Cancelar ',
        }).then((result) => {
            if (result.value) {
                redefinirsenha();
            } else {
                window.location.replace('<?= site_url("login/") ?>');
            }
        })
    </script>
<?php } ?>

<?php if (isset($senhaAlterada) && ($senhaAlterada != null) && ($senhaAlterada == true)) { ?>
    <script>

        swal({
            position: 'top',
            type: 'success',
            title: 'Senha alterada com sucesso!',
            showConfirmButton: true,
            showCancelButton: false,
            confirmButtonText: '<i class="fa fa-check fa-fw"></i> OK ',
            cancelButtonText: '<i class="fa fa-check fa-fw"></i> OK ',
            html:
                '<p class="mb-2">Você já pode acessar o sistema com sua nova senha.</p>',
        }).then((result) => {
            if (result.value) {
                window.location.replace('<?= site_url("login/") ?>');
            } else {
                window.location.replace('<?= site_url("login/") ?>');
            }
        })
    </script>
<?php } ?>

<?php if (isset($senhaAlterada) && ($senhaAlterada == false)) { ?>
    <script>
        swal({
            position: 'top',
            type: 'error',
            title: 'As senhas não correspondem!',
            showConfirmButton: true,
            showCancelButton: false,
            confirmButtonText: '<i class="fa fa-refresh fa-fw"></i> Tentar novamente ',
            cancelButtonText: '<i class="fa fa-times fa-fw"></i> Cancelar ',
        }).then((result) => {
            if (result.value) {

            } else {

            }
        })
    </script>
<?php } ?>

<!--
Função para redefinir senha via SweetAlert 2
-->
<script>
    function redefinirsenha() {

        swal({
            position: 'top',
            title: 'Esqueceu sua senha?',
            html: '<div>Informe seu e-mail de cadastro e lhe enviaremos instruções para alterar sua senha:</div>',
            input: 'email',
            inputPlaceholder: 'Digite seu e-mail',
            showCancelButton: true,
            confirmButtonText: '<i class="fa fa-send fa-fw"></i> Enviar ',
            cancelButtonText: '<i class="fa fa-times fa-fw"></i> Fechar ',
            reverseButtons: true,
            showLoaderOnConfirm: true,
            preConfirm: (email) => {
                return new Promise((resolve) => {
                    setTimeout(() => {
                        if (email === 'taken@example.com') {
                            swal.showValidationError(
                                'This email is already taken.'
                            )
                        }
                        resolve()
                    }, 2000)
                })
            },
            allowOutsideClick: () => !swal.isLoading()
        }).then((result) => {
            if (result.value) {
                $(function () {
                    $.ajax({
                        type: "POST",
                        url: "<?= site_url('redefinirsenha/gerartoken'); ?>",
                        data: {'usuarioemail': result.value}, // <--- THIS IS THE CHANGE
                        dataType: 'html',
                        cache: false,
                        success: function (resposta) {

                            var res = jQuery.parseJSON(resposta);

                            if (res.status === true) {
                                swal({
                                    position: 'top',
                                    type: 'success',
                                    title: 'E-mail enviado',
                                    showConfirmButton: true,
                                    showCancelButton: true,
                                    confirmButtonText: '<i class="fa fa-check fa-fw"></i> OK ',
                                    cancelButtonText: '<i class="fa fa-times fa-fw"></i> Fechar ',
                                    reverseButtons: true,
                                    html:
                                    '<p class="">Enviamos um e-mail para <strong class="text-success">' +
                                    res.email +
                                    '</strong>, ' +
                                    'verifique sua caixa de entrada ou pasta de <i>spam</i> e siga as instruções de recuperação.</p>',
                                }).then((result) => {
                                    if (result.value) {
                                        window.location.replace('<?= site_url() ?>' + 'redefinirsenha/verificartoken?token=' + res.token + '&id=' + res.id);
                                    } else {

                                    }
                                })
                            }
                            if (res.status === false) {
                                swal({
                                    position: 'top',
                                    type: 'error',
                                    title: 'Conta inexistente!',
                                    html: 'Não encontramos nenhuma conta cadastrada com o email <strong class="text-danger"> ' + res.email + '</strong>.',
                                    showConfirmButton: true,
                                    showCancelButton: true,
                                    reverseButtons: true,
                                    confirmButtonText: '<i class="fa fa-refresh fa-fw"></i> Tentar de novo ',
                                    cancelButtonText: '<i class="fa fa-times fa-fw"></i> Cancelar ',
                                }).then((result) => {
                                    if (result.value) {
                                        redefinirsenha();
                                    } else {

                                    }
                                })
                            }
                        },
                        error: function () {
                            alert('Erro!');

                        }
                    });

                });

            } else {

            }
        })
    }
</script>



