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
                <a href="<?= site_url('chamados/') ?>">Chamados</a>
            </li>
            <li class="breadcrumb-item active">Registrar novo chamado</li>
        </ol>
        <!-- ** Breadcrumbs-->
        <?php echo validation_errors(); ?>
        <div class="card">
            <div class="card-header">
                <h4>Registrar novo chamado</h4>
            </div>
            <div class="card-body">
                <form method="post" action="<?= site_url('chamados/cadastraChamado') ?>">
                    <label for="comment" class="font-weight-bold">Assunto:</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01"><i
                                        class="fa fa-list fa-fw"></i></label>
                        </div>
                        <!--
                        <select class="custom-select" name="assuntochamado" required autofocus>
                            <option value="" selected="selected"><<- selecione uma opção ->></option>
                            <option value="Manutenção">Manutenção</option>
                            <option value="Conta de usuário">Conta de usuário</option>
                            <option value="Senha">Senha</option>
                            <option value="Sistema">Sistema</option>
                            <option value="Solicitação">Solicitação</option>
                        </select>
                        -->

                        <select class="custom-select" name="assuntochamado" required>
                            <option value="" selected="selected"><<- selecione uma opção ->></option>
                            <?php foreach ($assunto->result() as $res) { ?>
                                <option value="<?= $res->id_assunto ?>">
                                    <?= $res->descricao ?>
                                </option>
                            <?php } ?>

                        </select>

                    </div>

                    <div class="form-group">
                        <label for="comment" class="font-weight-bold">Descrição:</label>
                        <textarea class="form-control" rows="5" name="descricaochamado" id="respostachamado"
                                  required></textarea>
                        <i class="fa fa-exclamation-circle fa-fw d-none text-danger" id="iconeLimite"></i>
                        <span class="small text-danger" id="limitecaracteres">255</span><span class="small text-danger"
                                                                                              id="avisocaracteres"> caracteres restantes</span>
                    </div>

                    <input type="hidden" name="idusuario" value="<?= ($this->session->userdata('idadministrador')) ?>"/>
                    <input type="hidden" name="statuschamado" value="1"/>

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
<script>
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
        } else {
            $('#avisocaracteres').text(' caracteres restantes');
            $('#avisocaracteres').removeClass('font-weight-bold');
            $('#iconeLimite').addClass('d-none');
            $("#limitecaracteres").text(caracteresRestantes);
        }
    });
</script>