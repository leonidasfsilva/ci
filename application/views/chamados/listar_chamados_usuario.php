<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//$this->load->view('header.php');
?>
<?php echo validation_errors(); ?>

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h4>Meus chamados</h4>
            </div>

            <div class="card-body">
                <div class="card-title">
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
                        <div>
                            <div class="alert bg-primary font-weight-bold">
                                <?= $chamados->num_rows() ?> chamados registrados
                            </div>
                        </div>
                    <?php } ?>

                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                        <tr>
                            <th>Nº Chamado</th>
                            <th>Data</th>
                            <th>Assunto</th>
                            <th>Descrição</th>
                            <th>Status</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php foreach ($chamados->result() as $res) {

                            // creating new date object
                            $date_time = new DateTime($res->data_chamado);

                            //now you can use format on that object:
                            $dataformatada = $date_time->format('d/m/Y - H:i');

                            switch ($res->notifica_usuario) {
                                case 0:
                                    $bg_row = '';
                                    break;
                                case 1:
                                    $bg_row = 'alert-info text-info';
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

                                <td>
                                    <?= $res->descricaochamado ?>
                                </td>

                                <?php foreach ($status->result() as $st) { ?>
                                    <?php
                                    switch ($st->idstatuschamado) {
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
                                    <?php if ($st->idstatuschamado == $res->statuschamado_id) { ?>
                                        <td class="<?= $class_alert ?> font-weight-bold">
                                            <?= $st->descricaostatus ?>
                                        </td>
                                    <?php } ?>
                                <?php } ?>
                                <!--
                                <td class="font-weight-bold">

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
                    <h5 class="text-center alert alert-info">Nenhum chamado encontrado!</h5>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php $this->load->view('footer.php'); ?>

</div>
</body>
</html>