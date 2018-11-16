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

                    <div class="form-group pb-3">
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


