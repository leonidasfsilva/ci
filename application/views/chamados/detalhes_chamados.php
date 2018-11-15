<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//$this->load->view('header.php');
?>

<div class="content-wrapper">
    <div class="container-fluid">
        <?php echo validation_errors();
        switch ($status->idstatuschamado) {
            case 0:
                $class_alert = 'bg-secondary';
                break;
            case 1:
                $class_alert = 'bg-danger';
                break;
            case 2:
                $class_alert = 'bg-warning';
                break;
            case 3:
                $class_alert = 'bg-success';
                break;
        }

        // creating new date object
        $date_time = new DateTime($chamado->data_chamado);

        //now you can use format on that object:
        $dataformatada = $date_time->format('d/m/Y - H:i');

        ?>

        <div class="card">
            <div class="card-header">
                <h4>Detalhes do chamado</h4>
            </div>
            <div class="card-body">
                <div class="card">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="card-text font-weight-bold">
                                Nº do Chamado:
                            </div>
                            <div class="card-text">
                                <?= $chamado->idchamado ?>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="card">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="card-text font-weight-bold">
                                Data e Hora do Chamado:
                            </div>
                            <div class="card-text">
                                <?= $dataformatada ?>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="card">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="card-text font-weight-bold">
                                Solicitante:
                            </div>
                            <div class="card-text">
                                <?= $admin->nome ?>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="card">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="card-text font-weight-bold">
                                Assunto:
                            </div>
                            <div class="card-text">
                                <?= $assunto->descricao ?>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="card">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="card-text font-weight-bold">
                                Descrição:
                            </div>
                            <div class="card-text">
                                <?= $chamado->descricaochamado ?>
                            </div>
                        </li>
                    </ul>
                </div>
                <?php if ($resposta->num_rows() > 0) { ?>
                    <div class="card">
                        <div class="card-header alert-dark text-center font-weight-bold">
                            RESPOSTAS
                        </div>
                        <?php foreach ($resposta->result() as $rs) { ?>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <div class="card-text font-weight-bold">
                                        <?= $rs->nomeusuario ?>:
                                    </div>
                                    <div class="card-text">
                                        <?= $rs->descricaoresposta ?>
                                    </div>
                                </li>
                            </ul>
                        <?php } ?>
                    </div>

                <?php } ?>
                <div class="card">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="card-text font-weight-bold">
                                Status:
                            </div>
                            <div class="alert font-weight-bold <?= $class_alert ?>">
                                <?= $status->descricaostatus ?>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card-footer">

                <a href="<?= site_url('chamados') ?>" class="btn btn-outline-secondary btn-sm"><i
                            class="fa fa-arrow-left fa-fw"></i> Voltar</a>

                <?php if ($status->idstatuschamado != 3 && $status->idstatuschamado != 0) { ?>
                    <?php if ($this->session->userdata('administradornivel') == 1 && $status->idstatuschamado != 2) { ?>
                        <a href="" data-toggle="modal" data-target="#analizarChamado"
                           class="btn btn-outline-warning btn-sm"><i class="fa fa-clock-o fa-fw"></i> Análise</a>
                    <?php } ?>
                    <a href="" data-toggle="modal" data-target="#finalizarChamado"
                       class="btn btn-outline-success btn-sm"><i class="fa fa-check fa-fw"></i> Finalizar</a>
                    <a href="" data-toggle="modal" data-target="#responderChamado"
                       class="btn btn-outline-primary btn-sm"><i class="fa fa-reply-all fa-fw"></i>
                        Responder</a>
                <?php } ?>
                <a class="btn btn-outline-danger btn-sm" id="excluirChamado"
                   title="Excluir chamado" href="?" data-toggle="modal"
                   data-target="#excluirModal" chamado="<?= $chamado->idchamado ?>">
                    <i class="fa fa-trash-o fa-fw"></i> Excluir
                </a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="finalizarChamado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <form action="<?= site_url('chamados/finalizar') ?>" method="post">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title" id="exampleModalLabel">Finalizar chamado?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="idchamado" value="<?= $chamado->idchamado ?>"/>
                    <input type="hidden" name="statuschamado" value="3"/>
                    <p>Deseja realmente finalizar este chamado?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-secondary btn-sm" type="button" data-dismiss="modal"><i
                                class="fa fa-fw fa-times"></i> Cancelar
                    </button>
                    <button class="btn btn-outline-success btn-sm"><i class="fa fa-fw fa-check"></i> Finalizar</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal fade" id="analizarChamado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <form action="<?= site_url('chamados/finalizar') ?>" method="post">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="exampleModalLabel">Análise de chamado?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="idchamado" value="<?= $chamado->idchamado ?>"/>
                    <input type="hidden" name="statuschamado" value="2"/>
                    <p>Deseja realmente colocar este chamado em análise?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-secondary btn-sm" type="button" data-dismiss="modal"><i
                                class="fa fa-fw fa-times"></i> Cancelar
                    </button>
                    <button class="btn btn-outline-success btn-sm"><i class="fa fa-fw fa-check"></i> Analisar</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal fade" id="responderChamado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <form action="<?= site_url('chamados/respondeChamado') ?>" method="post">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="exampleModalLabel">Responder chamado</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="comment" class="font-weight-bold">Resposta:</label>
                        <textarea class="form-control" rows="4" name="respostachamado" id="respostachamado"></textarea>
                        <i class="fa fa-exclamation-circle fa-fw d-none text-danger" id="iconeLimite"></i><span
                                class="small text-danger" id="limitecaracteres">255</span><span
                                class="small text-danger" id="avisocaracteres"> caracteres restantes</span>
                    </div>
                    <input type="hidden" name="nomeusuario"
                           value="<?= $this->session->userdata('administradornome') ?>"/>
                    <input type="hidden" name="idchamado" value="<?= $chamado->idchamado ?>"/>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-secondary btn-sm" type="button" data-dismiss="modal"><i
                                class="fa fa-fw fa-times"></i> Cancelar
                    </button>
                    <button class="btn btn-outline-success btn-sm" id="btnEnviar"><i class="fa fa-fw fa-send"></i>
                        Enviar
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="modal fade" id="excluirModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <form action="<?= site_url('chamados/excluir') ?>" method="post">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title" id="exampleModalLabel">Confirma exclusão?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="idChamado" name="chamado" value=""/>
                    <p>Deseja realmente excluir este chamado?</p>
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

<?php $this->load->view('footer.php'); ?>
</body>
</html>
<script>
    $(document).on('click', '#excluirChamado', function () {
        var chamado = $(this).attr('chamado');
        $('#idChamado').val(chamado);
    });

    $(document).on("input", "#respostachamado", function () {
        var limite = 255;
        var caracteresDigitados = $(this).val().length;
        var caracteresRestantes = limite - caracteresDigitados;

        $("#limitecaracteres").text(caracteresRestantes);

        if (caracteresRestantes < 0) {
            $('#avisocaracteres').text('Limite de caracteres excedido!');
            $('#avisocaracteres').addClass('font-weight-bold');
            $('#iconeLimite').removeClass('d-none');
            $('#limitecaracteres').text('');
            $('#btnEnviar').addClass('disabled');
        } else {
            $('#avisocaracteres').text(' caracteres restantes');
            $('#avisocaracteres').removeClass('font-weight-bold');
            $('#iconeLimite').addClass('d-none');
            $("#limitecaracteres").text(caracteresRestantes);
            $('#btnEnviar').removeClass('disabled');

        }
    });
</script>