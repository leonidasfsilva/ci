<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//$this->load->view('header.php');
?>

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <a href="<?=site_url('/painel') ?>" class="btn btn-outline-secondary float-left btn-sm"><i class="fa fa-home fa-fw"></i> Página inicial</a>

                <a href="<?=site_url('painel/cadastrarCategoria') ?>" class="btn btn-outline-primary float-right btn-sm"><i class="fa fa-plus fa-fw"></i> Nova categoria</a>
            </div>

            <div class="card-body">
                <div class="card-title">
                    <?php if ($this->session->flashdata('success') != null) { ?>
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <i class="fa fa-check-circle fa-lg fa-fw"></i> <?=$this->session->flashdata('success')?>

                        </div>
                    <?php } ?>

                    <?php if ($this->session->flashdata('warning') != null) { ?>
                        <div class="alert alert-warning alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <i class="fa fa-exclamation-circle fa-lg fa-fw"></i> <?=$this->session->flashdata('warning')?>

                        </div>
                    <?php } ?>

                    <?php if ($this->session->flashdata('danger') != null) { ?>
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <i class="fa fa-times-circle fa-lg fa-fw"></i> <?=$this->session->flashdata('danger')?>

                        </div>
                    <?php } ?>

                    <?php if ($categorias->num_rows() > 0) { ?>

                    <?php if ($categorias->num_rows() == 1) { ?>
                        <div>
                            <div class="panel-body font-weight-bold">
                                Categoria cadastrada: <?=$categorias->num_rows()?>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div>
                            <div class="panel-body font-weight-bold">
                                Categorias cadastradas: <?=$categorias->num_rows()?>
                            </div>
                        </div>
                    <?php } ?>
                </div>

                <table class="table table-striped table-hover table-bordered">
                    <thead>
                    <tr>

                        <th>Título da Categoria</th>
                        <th></th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php foreach($categorias->result() as $cat) { ?>
                        <tr>

                            <td class="font-weight-bold">
                                <a href="<?=site_url('usuario/index/'.$cat->idcategoria)?>">
                                    <?=$cat->categoriatitulo?>
                                </a>
                            </td>
                            <td>
                                <a href="<?=site_url('painel/alterarCategoria/'.$cat->idcategoria)?>" class="btn btn-sm btn-outline-warning my-1"><i class="fa fa-pencil-square-o fa-fw"></i> Alterar</a>
                                <a href="#" data-toggle="modal" data-target="#excluirModal" categoria="<?= $cat->idcategoria ?>"
                                   class="btn btn-sm btn-outline-danger my1"><i class="fa fa-ban fa-fw"></i> Excluir</a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <?php } else { ?>
                    <h4 class="text-center alert alert-info">Nenhum registro encontrado!</h4>
                <?php } ?>
            </div>
        </div>

        <div class="modal fade" id="excluirModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <form action="<?=site_url('painel/excluircategoria')?>" method="post" >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Confirma exclusão?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body alert-danger">
                            <input type="hidden" id="idCategoria" name="categoria" value="" />
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
    </div>
    <?php $this->load->view('footer.php'); ?>
    <script type="text/javascript">
        $(document).ready(function(){
            $(document).on('click', 'a', function(event) {
                var categoria = $(this).attr('categoria');
                $('#idCategoria').val(categoria);
            });
        });
    </script>
</div>

</body>
</html>