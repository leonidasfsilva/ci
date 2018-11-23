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
            <li class="breadcrumb-item">
                <a href="<?= site_url('admin/gerenciar/') ?>">Usuários</a>
            </li>
            <li class="breadcrumb-item active">Dados de usuário</li>
        </ol>
        <!-- ** Breadcrumbs-->
        <?php echo validation_errors(); ?>
        <div class="card">
            <div class="card-header">
                <h4>Alterar dados do usuário</h4>
            </div>
            <div class="card-body">
                <form method="post" action="<?= site_url('admin/alteraDadosAdmin/' . $admin->idadministrador) ?>">
                    <div class="form-group">
                        <label for="comment" class="font-weight-bold">Nome:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-user fa-fw"></i></span>
                            </div>
                            <input value="<?= $admin->administradornome ?>" type="text" class="form-control"
                                   id="administradornome" name="administradornome" placeholder="Nome do administrador"
                                   autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="comment" class="font-weight-bold">E-mail:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-at fa-fw"></i></span>
                            </div>
                            <input value="<?= $admin->administradoremail ?>" type="email" class="form-control"
                                   id="administradoremail" name="administradoremail"
                                   placeholder="E-mail do administrador">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="comment" class="font-weight-bold">Senha:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock fa-fw"></i></span>
                            </div>
                            <input type="password" class="form-control" id="administradorsenha"
                                   name="administradorsenha" placeholder="Senha do administrador">
                        </div>
                        <span class="small text-danger"><i class="fa fa-exclamation-circle fa-fw fa-lg"></i>Caso não queira alterar a senha, mantenha este campo em branco</span>
                    </div>

                    <label for="comment" class="font-weight-bold">Nível:</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01"><i
                                        class="fa fa-list fa-fw"></i></label>
                        </div>
                        <select class="custom-select" name="niveladministrador_id">

                            <?php foreach ($nivel->result() as $niv) { ?>
                                <option value="<?= $niv->idniveladministrador ?>"
                                    <?php if ($niv->idniveladministrador == $admin->niveladministrador_id) { ?>
                                        selected="selected"
                                    <?php } ?> >
                                    <?= $niv->descricaonivel ?>
                                </option>
                            <?php } ?>

                        </select>
                    </div>

                    <label for="comment" class="font-weight-bold">Status:</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01"><i
                                        class="fa fa-list fa-fw"></i></label>
                        </div>

                        <select class="custom-select" name="statusadministrador_id">
                            <?php foreach ($status->result() as $res) { ?>
                                <option value="<?= $res->idstatusadministrador ?>"
                                    <?php if ($res->idstatusadministrador == $admin->statusadministrador_id) { ?>
                                        selected="selected"
                                    <?php } ?> >
                                    <?= $res->descricaostatus ?>
                                </option>
                            <?php } ?>
                        </select>

                    </div>

                    <a href="javascript:history.back();" class="btn btn-outline-secondary btn-sm"><i
                                class="fa fa-times fa-fw"></i> Cancelar</a>
                    <button type="submit" class="btn btn-outline-success btn-sm"><i class="fa fa-check fa-fw"></i>
                        Alterar
                    </button>
                    <a href="#" data-toggle="modal" data-target="#excluirModal" admin="<?= $admin->idadministrador ?>"
                       class="btn btn-sm btn-outline-danger"><i class="fa fa-ban fa-fw"></i> Excluir</a>
                </form>
            </div>
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
</body>
</html>


