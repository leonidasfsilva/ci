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
            <li class="breadcrumb-item active">Meus dados</li>
        </ol>
        <!-- ** Breadcrumbs-->
        <?php echo validation_errors(); ?>
        <div class="card">
            <div class="card-header">
                <h4>Meus dados de cadastro</h4>
            </div>
            <div class="card-body">
                <form method="post" action="<?= site_url('admin/alteraMeusDados/') ?>">

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
                                   name="administradorsenha" placeholder="Senha">
                        </div>
                        <span class="small text-danger"><i class="fa fa-exclamation-circle fa-fw fa-lg"></i>Caso não queira alterar a senha, mantenha este campo em branco</span>
                    </div>

                    <?php if (($this->session->userdata('administradornivel')) == 1) { ?>

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

                    <?php } ?>

                    <a href="javascript:history.back();" class="btn btn-outline-secondary btn-sm"><i
                                class="fa fa-times fa-fw"></i> Cancelar</a>
                    <button type="submit" class="btn btn-outline-success btn-sm"><i class="fa fa-check fa-fw"></i>
                        Alterar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('footer.php'); ?>
</body>
</html>


