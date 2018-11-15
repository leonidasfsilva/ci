<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//$this->load->view('header.php');
?>

<div class="content-wrapper">
    <div class="container-fluid">

        <h3>Responder chamado</h3>

        <hr/>

        <?php echo validation_errors(); ?>

        <form method="post" action="<?=site_url('chamados/respondeChamado')?>">

            <label for="comment" class="font-weight-bold">Solicitante:</label>
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

            <div class="form-group">
                <label for="comment" class="font-weight-bold">Resposta:</label>
                <textarea class="form-control" rows="5" name="respostachamado" id="respostachamado"></textarea>
                <span class="small text-danger"><i class="fa fa-exclamation-circle fa-fw fa-lg"></i><span id="limitecaracteres">255</span> caracteres restantes</span>
            </div>

            <?php if ($this->session->userdata('administradornivel') == 1) { ?>

            <label for="comment" class="font-weight-bold">Status:</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Status</label>
                </div>
                <select class="custom-select" name="statuschamado">

                    <?php foreach($status->result() as $st){ ?>
                        <option value="<?=$st->idstatuschamado?>"
                            <?php if($st->idstatuschamado == $chamado->statuschamado_id){ ?>
                                selected="selected"
                            <?php } ?> >
                            <?=$st->descricaostatus?>
                        </option>
                    <?php } ?>

                </select>
            </div>

            <?php } ?>

            <input type="hidden" name="idchamado" value="<?= $idchamado ?>" />

            <a href="<?=site_url('chamados') ?>" class="btn btn-outline-danger"><i class="fa fa-times fa-fw"></i> Cancelar</a>
            <button type="submit" class="btn btn-outline-success float-right"><i class="fa fa-check fa-fw"></i> Finalizar</button>

        </form>
    </div>
</div>
<?php $this->load->view('footer.php'); ?>
</body>
</html>
<script>
    $(document).on("input", "#respostachamado", function () {
        var limite = 255;
        var caracteresDigitados = $(this).val().length;
        var caracteresRestantes = limite - caracteresDigitados;

        $("#limitecaracteres").text(caracteresRestantes);
    });
</script>