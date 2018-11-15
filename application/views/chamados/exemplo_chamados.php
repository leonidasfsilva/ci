<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//$this->load->view('header.php');
?>

<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#">Painel</a>
            </li>
            <li class="breadcrumb-item active">Tabelas</li>
        </ol>


        <?php echo validation_errors(); ?>

        <table class="table table-striped table-hover table-bordered">
            <thead>
            <tr>
                <th>Assunto</th>
                <th>Descrição</th>
                <th>Status</th>
                <th></th>
            </tr>
            </thead>

            <tbody>
            <?php foreach($chamado->result() as $res) { ?>

            <tr>

                <td>
                    <?=$res->assuntochamado?>
                </td>

                <td>
                    <?=$res->descricaochamado?>
                </td>


                <td class="font-weight-bold">
                    <a href="<?=site_url('chamados/detalhar/'.$res->idchamado)?>">
                        <i class="fa fa-search fa-fw"></i>
                    </a>
                </td>
            </tr>
            <?php } ?>
            </tbody>
        </table>

        <div class="card-body">
            <label for="comment" class="font-weight-bold">Usuário:</label>
            <div class="form-group">
                <div class="input-group">
                    <?= $nome ?>
                </div>
            </div>

            <label for="comment" class="font-weight-bold">Assunto:</label>
            <div class="form-group">
                <div class="input-group">
                    <?= $assunto ?>
                </div>
            </div>

            <label for="comment" class="font-weight-bold">Descrição:</label>
            <div class="form-group">
                <div class="input-group">
                    <?= $descricao ?>
                </div>
            </div>

            <label for="comment" class="font-weight-bold">Status:</label>

            <?php if ($status == 'Aberto') { ?>

            <div class="alert alert-danger font-weight-bold">
                <?= $status ?>
            </div>

            <?php } ?>

            <?php if ($status == 'Em análise') { ?>

            <div class="alert alert-warning font-weight-bold">
                <?= $status ?>
            </div>

            <?php } ?>

            <?php if ($status == 'Finalizado') { ?>

            <div class="alert alert-success font-weight-bold">
                <?= $status ?>
            </div>

            <?php } ?>


            <a href="<?=site_url('chamados') ?>" class="btn btn-outline-danger"><i class="fa fa-times fa-fw"></i> Cancelar</a>
            <button type="submit" class="btn btn-outline-success float-right"><i class="fa fa-check fa-fw"></i> Alterar</button>

            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fa fa-angle-up"></i>
            </a>

        </div>
    </div>
</div>

<div class="modal fade" id="excluirModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="<?=site_url('admin/excluir')?>" method="post" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirma exclusão?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body bg-warning">
                    <input type="hidden" id="idAdministrador" name="admin" value="" />
                    <p>Deseja realmente excluir este registro?</p>
                    <p><strong>ATENÇÃO!</strong> Esta ação não poderá ser desfeita!</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-danger font-weight-bold" type="button" data-dismiss="modal"><i class="fa fa-fw fa-times"></i> Não, cancelar</button>
                    <button class="btn btn-outline-success font-weight-bold"><i class="fa fa-fw fa-check"></i> Sim, excluir</button>
                </div>
            </div>
        </div>
    </form>
</div>

<?php $this->load->view('footer.php'); ?>
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('click', 'a', function(event) {
            var admin = $(this).attr('admin');
            $('#idAdministrador').val(admin);
        });
    });
</script>


</body>
</html>