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
            <li class="breadcrumb-item active">Novo usuário</li>
        </ol>
        <!-- ** Breadcrumbs-->
        <?php echo validation_errors(); ?>
        <div class="card">
            <div class="card-header">
                <h4>Cadastrar novo usuário</h4>
            </div>
            <div class="card-body">
                <form method="post" action="<?= site_url('admin/cadastraAdmin') ?>">

                    <div class="form-group">
                        <label for="comment" class="font-weight-bold">Nome:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-user fa-fw"></i></span>
                            </div>
                            <input type="text" class="form-control" id="administradornome" name="administradornome"
                                   placeholder="Nome" required autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="comment" class="font-weight-bold">E-mail:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-at fa-fw"></i></span>
                            </div>
                            <input type="email" class="form-control" id="administradoremail" name="administradoremail"
                                   placeholder="E-mail" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="comment" class="font-weight-bold">Senha:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock fa-fw"></i></span>
                            </div>
                            <input type="password" class="form-control" id="administradorsenha"
                                   name="administradorsenha" placeholder="Senha" required>
                        </div>
                    </div>

                    <label for="comment" class="font-weight-bold">Nível:</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01"><i
                                        class="fa fa-list fa-fw"></i></label>
                        </div>
                        <select class="custom-select" name="administradornivel" required>
                            <option value="" selected="selected">-- selecione --</option>
                            <option value="1">Administrador</option>
                            <option value="2">Usuário</option>
                        </select>
                    </div>

                    <label for="comment" class="font-weight-bold">Status:</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01"><i
                                        class="fa fa-list fa-fw"></i></label>
                        </div>
                        <select class="custom-select" name="administradorstatus" required>
                            <option value="" selected="selected">-- selecione --</option>
                            <option value="1">Ativo</option>
                            <option value="2">Inativo</option>
                            <option value="3">Desativado</option>
                        </select>
                    </div>

                    <a href="<?= site_url('painel') ?>" class="btn btn-outline-secondary btn-sm"><i
                                class="fa fa-times fa-fw"></i> Cancelar</a>
                    <button type="submit" class="btn btn-outline-success btn-sm"><i class="fa fa-check fa-fw"></i>
                        Cadastrar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('footer.php'); ?>
</body>
</html>