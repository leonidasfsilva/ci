<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//$this->load->view('header.php');
?>

<div class="content-wrapper">
    <div class="container-fluid">
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
                            <div class="alert alert-info">
                                <?= $usuarios->num_rows() ?> registro encontrado
                            </div>
                        </div>
                    <?php } else { ?>
                        <div>
                            <div class="alert alert-info">
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
                            <th>Nível</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php foreach ($usuarios->result() as $users) { ?>
                            <tr>

                                <td>
                                    <?= $users->administradornome ?>
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
                                            <td class="alert alert-success">
                                                <?= $st->descricaostatus ?>
                                            </td>
                                        <?php } ?>

                                        <?php if ($st->idstatusadministrador == 2) { ?>
                                            <td class="alert alert-warning">
                                                <?= $st->descricaostatus ?>
                                            </td>
                                        <?php } ?>

                                        <?php if ($st->idstatusadministrador == 3) { ?>
                                            <td class="alert alert-danger">
                                                <?= $st->descricaostatus ?>
                                            </td>
                                        <?php } ?>
                                    <?php } ?>

                                <?php } ?>

                                <td>
                                    <a href="<?= site_url('admin/alterarDados/' . $users->idadministrador) ?>"
                                       class="btn btn-sm btn-outline-warning"><i
                                                class="fa fa-pencil-square-o fa-fw"></i> Alterar</a>
                                    <a href="#" data-toggle="modal" data-target="#excluirModal"
                                       admin="<?= $users->idadministrador ?>"
                                       class="btn btn-sm btn-outline-danger"><i class="fa fa-ban fa-fw"></i> Excluir</a>
                                </td>
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

        <div class="modal fade" id="excluirModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <form action="<?= site_url('admin/excluir') ?>" method="post">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-danger">
                            <h5 class="modal-title" id="exampleModalLabel">Confirma exclusão?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="idAdministrador" name="admin" value=""/>
                            <p>Deseja realmente excluir este registro?</p>
                            <p><strong>ATENÇÃO!</strong> Esta ação não poderá ser desfeita!</p>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-outline-secondary btn-sm" type="button" data-dismiss="modal">
                                <i class="fa fa-fw fa-times"></i> Cancelar
                            </button>
                            <button class="btn btn-outline-danger btn-sm"><i class="fa fa-fw fa-trash-o"></i>
                                Excluir
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php $this->load->view('footer.php'); ?>
    <script type="text/javascript">
        $(document).ready(function () {
            $(document).on('click', 'a', function (event) {
                var admin = $(this).attr('admin');
                $('#idAdministrador').val(admin);
            });
        });
    </script>
</div>

</body>
</html>