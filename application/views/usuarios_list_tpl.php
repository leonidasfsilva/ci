<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//$this->load->view('header.php');
?>

<div class="content-wrapper">
    <div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <a href="<?=site_url('painel/exibircategorias') ?>" class="btn btn-outline-secondary float-left btn-sm"><i class="fa fa-list fa-fw"></i> Categorias</a>

            <a href="<?=site_url('usuario/cadastrarUsuario/'.$dadosCategoria->idcategoria) ?>" class="btn btn-outline-primary float-right btn-sm"><i class="fa fa-plus fa-fw"></i> Novo usuário</a>
        </div>

        <div class="card-body">
            <div class="card-title">

                <?php if ($this->session->flashdata('success') != null) { ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <i class="fa fa-check fa-fw"></i> <?=$this->session->flashdata('success')?>

                    </div>
                <?php } ?>

                <?php if ($this->session->flashdata('error') != null) { ?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <i class="fa fa-times fa-fw"></i> <?=$this->session->flashdata('error')?>

                    </div>
                <?php } ?>

                <?php if ($clientes->num_rows() > 0) { ?>

                <?php if ($clientes->num_rows() == 1) { ?>
                    <div>
                        <div class="panel-body font-weight-bold">
                            Categoria <?=$dadosCategoria->categoriatitulo?>: <?=$clientes->num_rows()?> usuário cadastrado
                        </div>
                    </div>
                <?php } else { ?>
                    <div >
                        <div class="panel-body font-weight-bold">
                           Categoria  <?=$dadosCategoria->categoriatitulo?>: <?=$clientes->num_rows()?> usuários cadastrados
                        </div>
                    </div>
                <?php } ?>
            </div>

            <table class="table table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th>Nome do usuário</th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                <?php foreach($clientes->result() as $cli) { ?>
                    <tr>
                        <td><?=$cli->usuarionome?></td>
                        <td>
                            <a href="<?=site_url('usuario/alterarUsuario/'.$cli->idusuario)?>" class="btn btn-sm btn-outline-warning"><i class="fa fa-pencil-square-o fa-fw"></i> Alterar</a>
                            <a href="#" role="button" data-target="#excluirModal"
                               class="btn btn-sm btn-outline-danger" data-toggle="modal" usuario="<?= $cli->idusuario ?>" categoria="<?= $dadosCategoria->idcategoria ?>">
                                <i class="fa fa-ban fa-fw"></i> Excluir</a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            <?php } else { ?>
                <h4 class="alert alert-info text-center">Nenhum registro encontrado em: <?=$dadosCategoria->categoriatitulo?></h4>
            <?php } ?>
        </div>
    </div>
</div>
<div class="modal fade" id="excluirModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="<?=site_url('usuario/excluirUsuario')?>" method="post" >
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
                <input type="hidden" id="idUsuario" name="usuario" value="" />
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
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('click', 'a', function(event) {
            var usuario = $(this).attr('usuario');
            $('#idUsuario').val(usuario);
            var categoria = $(this).attr('categoria');
            $('#idCategoria').val(categoria);
        });
    });
</script>
<?php include 'footer.php' ?>
</div>
</body>
</html>