<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- As 3 meta tags acima *devem* vir em primeiro lugar dentro do `head`; qualquer outro conteúdo deve vir *após* essas tags -->
    <title>Mx Code Sistemas</title>

    <!-- Bootstrap -->
    <link href="<?= base_url('/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('/vendor/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('/vendor/datatables/dataTables.bootstrap4.css') ?>" rel="stylesheet">

    <!-- CSS Custom Theme -->
    <link href="<?= base_url('/dist/css/sb-admin.css') ?>" rel="stylesheet">


    <!-- HTML5 shim e Respond.js para suporte no IE8 de elementos HTML5 e media queries -->
    <!-- ALERTA: Respond.js não funciona se você visualizar uma página file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

	<!--
	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;

	}

	a {
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
	-->
</head>
<body class="fixed-nav sticky-footer d-flex " id="page-top">

<nav class="navbar navbar-toggleable-sm navbar-full navbar-dark bg-dark fixed-top">
    <a class="navbar-brand font-weight-bold" href="<?=site_url('/')?>">
        MX Code Sistemas
    </a>
</nav>

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card" id="container">
	<h4 class=" font-weight-bold">Sistema de Gestão Integrado para Igrejas</h4>

	<div id="body">
		<p>Este protótipo de sistema utiliza o código do framework CodeIgniter (<?php echo  (ENVIRONMENT === 'development') ?  'Versão <strong>' . CI_VERSION . '</strong>' : '' ?>) em seu núcleo de desenvolvimento.</p>

		<p>Caso tenha interesse em testar esta aplicação, entre em contato com o desenvolvedor do sistema e solicite o período de teste.</p>
        <a href="" class="btn btn-outline-primary font-weight-bold">Solicitar período de teste <i class="fa fa-commenting fa-fw"></i></a>
        <br>
        <br>
		<p>Se você está explorando o CodeIgniter pela primeira vez, você deve iniciar pela leitura do manual do usuário, clicando no botão abaixo:</p>
        <a href="<?=base_url('/user_guide')?>" class="btn btn-outline-primary font-weight-bold">Manual do usuário <i class="fa fa-book fa-fw"></i></a>
        <br>
        <br>
        <div class="alert alert-warning">
            <h6 class="font-weight-bold">Atenção!</h6>
            <p>Esta aplicação encontra-se em desenvolvimento e atualmente opera em versão <i>beta</i>, o que pode resultar em algum tipo de instabilidade ou apresentação de erros durante sua execução.</p>
        </div>
        <p>Caso já possua uma conta, acesse o sistema clicando no botão <strong>Iniciar sessão</strong> abaixo.</p>

    </div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>

<div class="card" id="container">
    <div class="card-header lead font-weight-bold">
        Acesso ao Sistema
    </div>
    <div class="card-body">
        <a class="btn btn-outline-primary float-left font-weight-bold" href="<?=site_url('login')?>" role="button">Acessar sistema <i class="fa fa-sign-in fa-fw"></i>
        <a class="btn btn-outline-secondary float-right font-weight-bold" href="<?=site_url('/phpinfo.php')?>" role="button"><i class="fa fa-info-circle fa-fw"></i> Versão PHP</a>
    </div>
</div>
</div>
    <?php $this->load->view('footer.php'); ?>

</div>
</body>
</html>