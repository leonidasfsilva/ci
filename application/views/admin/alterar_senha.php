<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//$this->load->view('header.php');
?>

<div class="content-wrapper">
    <div class="container-fluid">

            <h3>Alterar minha senha</h3>

            <hr/>

            <?php echo validation_errors(); ?>

            <?php if ($this->session->flashdata('success') != null) { ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <i class="fa fa-check-circle fa-fw"></i><span class="small"> <?=$this->session->flashdata('success')?></span>

                </div>
            <?php } ?>

            <?php if ($this->session->flashdata('danger') != null) { ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <i class="fa fa-times-circle fa-fw"></i><span class="small"> <?=$this->session->flashdata('danger')?></span>

                </div>
            <?php } ?>

            <form method="post" action="<?=site_url('admin/alterasenha/')?>">

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock fa-fw"></i></span>
                        </div>
                        <input type="password" class="form-control" id="novasenha" name="novasenha" placeholder="Digite sua nova senha" autofocus required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock fa-fw"></i></span>
                        </div>
                        <input type="password" class="form-control" id="confirmacaosenha" name="confirmacaosenha" placeholder="Confirme sua nova senha" required>
                    </div>
                </div>

                <a href="<?=site_url('painel')?>" class="btn btn-outline-secondary btn-sm"><i class="fa fa-times fa-fw"></i> Cancelar</a>
                <button type="submit" class="btn btn-outline-success btn-sm"><i class="fa fa-check fa-fw"></i> Alterar</button>
            </form>
    </div>
</div>
<?php $this->load->view('footer.php'); ?>
</body>
</html>


