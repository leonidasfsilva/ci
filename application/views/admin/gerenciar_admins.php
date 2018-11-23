<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//$this->load->view('header.php');
?>

<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs **-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= site_url('painel/') ?>">Painel</a>
            </li>
            <li class="breadcrumb-item active">Usuários</li>
        </ol>
        <!-- ** Breadcrumbs-->
        <div class="card">
            <div class="card-header">
                <h3>Gerenciar Usuários</h3>
            </div>
            <div class="card-body">
                <div class="card-title">
                    <?php if ($this->session->flashdata('success') != null) { ?>
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <i class="fa fa-check-circle fa-lg fa-fw"></i><span
                                    class="small"> <?= $this->session->flashdata('success') ?></span>
                        </div>
                    <?php } ?>

                    <?php if ($this->session->flashdata('warning') != null) { ?>
                        <div class="alert alert-warning alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <i class="fa fa-exclamation-circle fa-lg fa-fw"></i><span
                                    class="small"> <?= $this->session->flashdata('warning') ?></span>
                        </div>
                    <?php } ?>

                    <?php if ($this->session->flashdata('danger') != null) { ?>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <i class="fa fa-times-circle fa-lg fa-fw"></i><span
                                    class="small"> <?= $this->session->flashdata('danger') ?></span>
                        </div>
                    <?php } ?>

                    <?php if ($usuarios->num_rows() > 0) { ?>

                    <?php if ($usuarios->num_rows() == 1) { ?>
                        <div>
                            <div class="alert bg-primary font-weight-bold">
                                <?= $usuarios->num_rows() ?> registro encontrado
                            </div>
                        </div>
                    <?php } else { ?>
                        <div>
                            <div class="alert bg-primary font-weight-bold">
                                <?= $usuarios->num_rows() ?> registros encontrados
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                        <tr>
                            <th>Usuário</th>
                            <th>Email</th>
                            <th>Nível</th>
                            <th>Status</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php foreach ($usuarios->result() as $users) { ?>
                            <tr onclick="location.href='<?= site_url('admin/alterarDados/' . $users->idadministrador) ?>'"
                                style="cursor: pointer">

                                <td>
                                    <?= $users->administradornome ?>
                                </td>

                                <td>
                                    <?= $users->administradoremail ?>
                                </td>

                                <?php foreach ($nivel->result() as $nv) { ?>

                                    <?php if ($nv->idniveladministrador == $users->niveladministrador_id) { ?>
                                        <td>
                                            <?= $nv->descricaonivel ?>
                                        </td>
                                    <?php } ?>

                                <?php } ?>

                                <?php foreach ($status->result() as $st) { ?>
                                    <?php if ($st->idstatusadministrador == $users->statusadministrador_id) { ?>
                                        <?php if ($st->idstatusadministrador == 1) { ?>
                                            <td class="alert bg-success font-weight-bold">
                                                <?= $st->descricaostatus ?>
                                            </td>
                                        <?php } ?>

                                        <?php if ($st->idstatusadministrador == 2) { ?>
                                            <td class="alert bg-warning font-weight-bold">
                                                <?= $st->descricaostatus ?>
                                            </td>
                                        <?php } ?>

                                        <?php if ($st->idstatusadministrador == 3) { ?>
                                            <td class="alert bg-danger font-weight-bold">
                                                <?= $st->descricaostatus ?>
                                            </td>
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <?php } else { ?>
                    <h4 class="text-center alert alert-info">Nenhum registro encontrado!</h4>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php $this->load->view('footer.php'); ?>
</div>

</body>
</html>