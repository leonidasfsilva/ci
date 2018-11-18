<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- As 3 meta tags acima *devem* vir em primeiro lugar dentro do `head`; qualquer outro conteúdo deve vir *após* essas tags -->
    <title>Sistema de Cadastro</title>

    <!-- Bootstrap core CSS-->
    <link href="<?= base_url('/vendor/bootstrap/css/bootstrap.css') ?>" rel="stylesheet">
    <!-- Custom fonts-->
    <link href="<?= base_url('/vendor/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet">
    <!-- Page level plugin CSS-->
    <link href="<?= base_url('/vendor/datatables/dataTables.bootstrap4.css') ?>" rel="stylesheet">
    <!-- CSS Custom Theme -->
    <link href="<?= base_url('/dist/css/sb-admin.css') ?>" rel="stylesheet">
    <link href="<?= base_url('/dist/css/sweetalert2.min.css') ?>" rel="stylesheet">

    <script src="<?= base_url('/dist/js/sweetalert2.js') ?>"></script>


    <!-- HTML5 shim e Respond.js para suporte no IE8 de elementos HTML5 e media queries -->
    <!-- ALERTA: Respond.js não funciona se você visualizar uma página file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->
</head>
<body class="fixed-nav sticky-footer bg-dark" id="page-top">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand font-weight-bold" href="<?= site_url('/painel') ?>">MX Code Sistemas</a>
    <?php if ($this->session->userdata('logado', true)) { ?>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">

            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Pesquisar">
                <form class="nav-link-text form-inline my-0 mx-2">
                    <div class="input-group">
                        <input class="form-control" type="text" placeholder="Pesquisar">
                        <span class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                </form>
            </li>

            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Painel de Controle">
                <a class="nav-link" href="<?= site_url('/painel') ?>">
                    <i class="fa fa-fw fa-dashboard"></i>
                    <span class="nav-link-text">Painel de Controle</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Gráficos">
                <a class="nav-link" href="#">
                    <i class="fa fa-fw fa-area-chart"></i>
                    <span class="nav-link-text">Gráficos</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Componentes">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" data-target="#collapseComponents"
                   data-parent="#exampleAccordion" aria-expanded="false">
                    <i class="fa fa-fw fa-wrench"></i>
                    <span class="nav-link-text">Componentes</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseComponents">
                    <li>
                        <a href="#">Navbar</a>
                    </li>
                    <li>
                        <a href="#">Cards</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Níveis de Menu">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti"
                   data-parent="#exampleAccordion">
                    <i class="fa fa-fw fa-sitemap"></i>
                    <span class="nav-link-text">Níveis de Menu</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseMulti">
                    <li>
                        <a href="#">Item de Segundo Nível</a>
                    </li>
                    <li>
                        <a href="#">Item de Segundo Nível</a>
                    </li>
                    <li>
                        <a href="#">Item de Segundo Nível</a>
                    </li>
                    <li>
                        <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti2">Terceiro
                            Nível</a>
                        <ul class="sidenav-third-level collapse" id="collapseMulti2">
                            <li>
                                <a href="#">Item de Terceiro Nível</a>
                            </li>
                            <li>
                                <a href="#">Item de Terceiro Nível</a>
                            </li>
                            <li>
                                <a href="#">Item de Terceiro Nível</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Mudar cor do sistema">
                <a class="nav-link" href="#" id="toggleNavColor">
                    <i class="fa fa-fw fa-refresh"></i>
                    <span class="nav-link-text">Mudar cor do sistema</span>
                </a>
            </li>
        </ul>

        <ul class="navbar-nav sidenav-toggler" data-toggle="tooltip" data-placement="right" title="Recolher menu">
            <li class="nav-item">
                <a class="nav-link text-center" id="sidenavToggler">
                    <i class="fa fa-fw fa-angle-left"></i>
                    <span class="nav-link-text"></span>
                </a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown" title="Notificações">
                <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-fw fa-bell"></i>
                    <span class="">Notificações
<!--              <span class="badge badge-pill badge-warning d-lg-none">12 New</span>-->
            </span>
                    <span class="indicator text-warning d-none d-lg-block">
<!--              <i class="fa fa-fw fa-circle"></i>-->
            </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
                    <h6 class="dropdown-header">New Messages:</h6>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">
                        <strong>David Miller</strong>
                        <span class="small float-right text-muted">11:21 AM</span>
                        <div class="dropdown-message small">Hey there! This new version of SB Admin is pretty awesome!
                            These messages clip off when they reach the end of the box so they don't overflow over to
                            the sides!
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">
                        <strong>Jane Smith</strong>
                        <span class="small float-right text-muted">11:21 AM</span>
                        <div class="dropdown-message small">I was wondering if you could meet for an appointment at 3:00
                            instead of 4:00. Thanks!
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">
                        <strong>John Doe</strong>
                        <span class="small float-right text-muted">11:21 AM</span>
                        <div class="dropdown-message small">I've sent the final files over to you for review. When
                            you're able to sign off of them let me know and we can discuss distribution.
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item small" href="#">View all messages</a>
                </div>
            </li>

            <li class="nav-item dropdown" title="Chamados">
                <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-fw fa-envelope"></i>
                    <span class="">Chamados
                        <?php if ($notificacao->num_rows() > 0) { ?>
                        <span class="badge badge-pill badge-warning d-lg-none"><?= $notificacao->num_rows() ?>
                            <?php if ($notificacao->num_rows() > 1) { ?>
                             notificações
                            <?php } else { ?>
                             notificação
                            <?php } ?>
                        </span>
                    </span>
                    <span class="indicator text-warning d-none d-lg-block">
                        <i class="fa fa-fw fa-circle"></i>
                    </span>
                    <?php } ?>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
                    <h6 class="dropdown-header d-none d-md-block">Chamados:</h6>
                    <div class="dropdown-divider d-none d-md-block"></div>

                    <?php if ($this->session->userdata('administradornivel') == 1) { ?>

                        <a class="dropdown-item text-muted"
                           href="<?= site_url('chamados/') ?>">
                            <i class="fa fa-list fa-fw"></i> Listar chamados
                        </a>
                    <?php } ?>

                    <?php if ($this->session->userdata('administradornivel') == 2) { ?>

                        <a class="dropdown-item text-muted"
                           href="<?= site_url('chamados/') ?>">
                            <i class="fa fa-list fa-fw"></i> Meus chamados
                        </a>
                    <?php } ?>

                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item text-muted"
                       href="<?= site_url('chamados/registrar') ?>">
                        <i class="fa fa-plus fa-fw"></i> Abrir chamado
                    </a>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-fw fa-user-circle"></i>
                    <span><?= ($this->session->userdata('administradornome')) ?>
                        <span class="badge badge-pill badge-success d-none">6 New</span>
            </span>
                    <span class="indicator text-success d-none d-lg-block">
              <i class="fa fa-fw fa-circle d-none"></i>
            </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">

                    <a class="dropdown-item text-muted"
                       href="<?= site_url('admin/meusdados/') ?>">
                        <i class="fa fa-address-card-o fa-fw"></i> Meus dados
                    </a>

                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item text-muted"
                       href="<?= site_url('admin/alterarsenha/') ?>">
                        <i class="fa fa-refresh fa-fw"></i> Alterar senha
                    </a>
                    <div class="dropdown-divider"></div>

                    <?php if (($this->session->userdata('administradornivel')) == 1) { ?>

                        <a class="dropdown-item text-muted" href="<?= site_url('admin/cadastrar') ?>">
                      <span class="text-muted">
                          <i class="fa fa-user-plus fa-fw"></i> Cadastrar usuário
                      </span>
                        </a>

                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item text-muted" href="<?= site_url('admin/gerenciar') ?>">
                            <i class="fa fa-users fa-fw"></i> Gerenciar usuários
                        </a>
                        <div class="dropdown-divider"></div>

                    <?php } ?>

                    <a class="dropdown-item text-muted" href="#" onclick="sair()">
                        <i class="fa fa-sign-out fa-fw fa-rotate-180"></i> Sair
                    </a>
                </div>
            </li>
        </ul>
        <?php } ?>

    </div>
</nav>

<?php if ($this->session->flashdata('loginSuccess') != null) { ?>
    <script>
        swal({
            position: 'top',
            type: 'success',
            title: '<h4>Conectado</h4>',
            text: '<?=$this->session->flashdata("loginSuccess")?>',
            showConfirmButton: false,
            showCancelButton: false,
            showCloseButton: false,
            timer: 1200
        });
    </script>
<?php } ?>

<?php if ($this->session->flashdata('alert-warning') != null) { ?>
    <script>
        swal({
            position: 'top',
            type: 'success',
            title: 'Conectado!',
            text: '<?=$this->session->flashdata("alert-warning")?>',
            showConfirmButton: false,
            showCancelButton: false,
            showCloseButton: false,
            timer: 3000
        });
    </script>
<?php } ?>

<?php if ($this->session->flashdata('alert-danger') != null) { ?>
    <script>
        swal({
            position: 'top',
            type: 'success',
            title: 'Conectado!',
            text: '<?=$this->session->flashdata("alert-danger")?>',
            showConfirmButton: false,
            showCancelButton: false,
            showCloseButton: false,
            timer: 3000
        });
    </script>
<?php } ?>


<!--
Função para sair
-->
<script>
    function sair() {
        swal(
            {
                position: 'top',
                html:
                    '<h5 class="lead">Deseja realmente sair do sistema?</h5>',
                showCancelButton: true,
                focusConfirm: true,
                buttonsStyling: true,
                reverseButtons: true,
                cancelButtonText:
                    '<i class="fa fa-times fa-fw"></i> Não ',
                confirmButtonText:
                    '<i class="fa fa-check fa-fw"></i> Sim ',
            }
        ).then((result) => {
            if (result.value) {
                swal(
                    {
                        position: 'top',
                        type: 'success',
                        showConfirmButton: false,
                        title: '<h4>Sessão encerrada</h4>',
                        text: 'Até logo, <?=$this->session->userdata("administradornome") ?>!',
                        timer: 2000
                    }
                );
                setTimeout(function () {
                    window.location.replace('<?= site_url("login/sair") ?>');
                }, 1000);
            }
        })
    }
</script>




