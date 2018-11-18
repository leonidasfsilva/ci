<footer class="sticky-footer">
    <div class="container">
        <div class="text-center">
            <small>Copyright © <?= date('Y') ?> | <a href="http://mxcode.net" target="_blank">MX Code Sistemas</a>
            </small>
        </div>
    </div>
</footer>

<!-- Logout Modal-->
<div class="modal fade" id="sairModal" tabindex="-10" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sair do sistema?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Deseja realmente encerrar a sessão atual?</div>
            <div class="modal-footer">
                <button class="btn btn-outline-danger font-weight-bold" type="button" data-dismiss="modal"><i
                            class="fa fa-fw fa-times"></i> Não, cancelar
                </button>
                <a class="btn btn-outline-success font-weight-bold" href="<?= site_url('login/sair') ?>"><i
                            class="fa fa-fw fa-check"></i> Sim, encerrar</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('/vendor/jquery/jquery.js') ?>"></script>
<!-- Inclui todos os plugins compilados (abaixo), ou inclua arquivos separadados se necessário -->
<script src="<?= base_url('/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<!-- Core plugin JavaScript-->
<script src="<?= base_url('/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>
<!-- Page level plugin JavaScript-->
<script src="<?= base_url('/vendor/chart.js/Chart.min.js') ?>"></script>
<script src="<?= base_url('/vendor/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?= base_url('/vendor/datatables/dataTables.bootstrap4.js') ?>"></script>
<!--<script src="--><? //= base_url('/vendor/metisMenu/metisMenu.js') ?><!--"></script>-->
<!-- Custom Theme JavaScript -->
<script src="<?= base_url('/dist/js/sb-admin.min.js') ?>"></script>
<script src="<?= base_url('/dist/js/sb-admin-datatables.min.js') ?>"></script>
<script src="<?= base_url('/dist/js/sb-admin-charts.min.js') ?>"></script>


<script>
    //Mudar cor do sistema

    $(document).on('click', '#toggleNavColor', function () {
        $('#mainNav').toggleClass('navbar-dark navbar-light');
        $('#mainNav').toggleClass('bg-dark bg-light');
        $('body').toggleClass('bg-dark bg-light');
    });

    //Mudar posição do menu do sistema
    $(document).on('click', '#toggleNavPosition', function () {
        $('body').toggleClass('fixed-nav');
        $('nav').toggleClass('fixed-top static-top');
    });
</script>




