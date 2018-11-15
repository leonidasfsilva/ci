<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//$this->load->view('header.php');
?>

<div class="content-wrapper">
    <?php echo validation_errors(); ?>

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="container-fluid">
                    <span class="pull-left">
                        <h4>Gerenciar chamados</h4>
                    </span>
                    <span class="pull-right">
                        <a class="btn btn-outline-primary btn-sm" href="#"><i class="fa fa-plus fa-fw"></i>Abrir chamado</a>
                    </span>
                </div>
            </div>

            <div class="card-body">
                <?php if ($this->session->flashdata('success') != null) { ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <i class="fa fa-check-circle fa-fw"></i><span
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
                        <i class="fa fa-times-circle fa-fw"></i><span
                                class="small"> <?= $this->session->flashdata('danger') ?></span>
                    </div>
                <?php } ?>

                <?php if ($chamados->num_rows() > 0) { ?>

                    <?php if ($chamados->num_rows() == 1) { ?>
                        <div>
                            <div class="alert bg-primary font-weight-bold">
                                <?= $chamados->num_rows() ?> chamado registrado
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="alert bg-primary font-weight-bold col-md-12">
                                    <?= $chamados->num_rows() ?> chamados registrados
                                </div>
                                <?php if ($chamados_abertos->num_rows() > 0) { ?>
                                    <div class="alert bg-danger font-weight-bold col-md-3">
                                        <?= $chamados_abertos->num_rows() ?> em aberto
                                    </div>
                                <?php }
                                if ($chamados_analisados->num_rows() > 0) { ?>
                                    <div class="alert bg-warning font-weight-bold col-md-3">
                                        <?= $chamados_analisados->num_rows() ?> em análise
                                    </div>
                                <?php }
                                if ($chamados_finalizados->num_rows() > 0) { ?>
                                    <div class="alert bg-success font-weight-bold col-md-3">
                                        <?= $chamados_finalizados->num_rows() ?> finalizado(s)
                                    </div>
                                <?php }
                                if ($chamados_excluidos->num_rows() > 0) { ?>
                                    <div class="alert bg-secondary font-weight-bold col-md-3">
                                        <?= $chamados_excluidos->num_rows() ?> excluído(s)
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="table-responsive">
                        <table class="table  table-hover table-bordered">
                            <thead>
                            <tr>
                                <th>Nº Chamado</th>
                                <th>Data</th>
                                <th>Assunto</th>
                                <th>Solicitante</th>
                                <th>Status</th>
                                <!--<th></th>-->
                            </tr>
                            </thead>

                            <tbody>
                            <?php foreach ($chamados->result() as $res) {

                                // creating new date object
                                $date_time = new DateTime($res->data_chamado);

                                //now you can use format on that object:
                                $dataformatada = $date_time->format('d/m/Y - H:i');

                                switch ($res->notifica_admin) {
                                    case 0:
                                        $bg_row = '';
                                        break;
                                    case 1:
                                        $bg_row = 'alert-info';
                                        break;
                                }
                                ?>
                                <tr class="<?= $bg_row ?>" style="cursor:pointer"
                                    onclick="location.href='<?= site_url('chamados/detalhar/' . $res->idchamado) ?>'">
                                    <td>
                                        <?= $res->idchamado ?>
                                    </td>
                                    <td>
                                        <?= $dataformatada ?>
                                    </td>
                                    <?php foreach ($assunto->result() as $as) { ?>
                                        <?php if ($as->id_assunto == $res->assunto_id) { ?>
                                            <td>
                                                <?= $as->descricao ?>
                                            </td>
                                        <?php } ?>
                                    <?php } ?>
                                    <?php foreach ($admin->result() as $ad) { ?>
                                        <?php if ($ad->idadministrador == $res->administrador_id) { ?>
                                            <td>
                                                <?= $ad->administradornome ?>
                                            </td>
                                        <?php } ?>
                                    <?php } ?>
                                    <?php foreach ($status->result() as $st) { ?>
                                        <?php if ($st->idstatuschamado == $res->statuschamado_id) {
                                            switch ($res->statuschamado_id) {
                                                case 0:
                                                    $class_alert = 'alert bg-secondary';
                                                    break;
                                                case 1:
                                                    $class_alert = 'alert bg-danger';
                                                    break;
                                                case 2:
                                                    $class_alert = 'alert bg-warning';
                                                    break;
                                                case 3:
                                                    $class_alert = 'alert bg-success';
                                                    break;
                                            }
                                            ?>
                                            <td class="font-weight-bold <?= $class_alert ?>">
                                                <?= $st->descricaostatus ?>
                                            </td>
                                        <?php } ?>
                                    <?php } ?>
                                    <!--
                                    <td>
                                        <a class="btn btn-outline-primary btn-sm" title="Mais detalhes"
                                           href="<?= site_url('chamados/detalhar/' . $res->idchamado) ?>">
                                            <i class="fa fa-search-plus fa-fw"></i>
                                        </a>
                                    </td>
                                    -->
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                <?php } else { ?>
                    <h4 class="text-center alert alert-info">Nenhum chamado encontrado!</h4>
                <?php } ?>
            </div>
        </div>

        <div class="modal fade" id="excluirModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <form action="<?= site_url('admin/excluir') ?>" method="post">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Confirma exclusão?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body bg-warning">
                            <input type="hidden" id="idChamado" name="admin" value=""/>
                            <p>Deseja realmente excluir este registro?</p>
                            <p><strong>ATENÇÃO!</strong> Esta ação não poderá ser desfeita!</p>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-outline-danger btn-sm" type="button" data-dismiss="modal">
                                <i class="fa fa-fw fa-times"></i> Não, cancelar
                            </button>
                            <button class="btn btn-outline-success btn-sm"><i class="fa fa-fw fa-check"></i>
                                Sim, excluir
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