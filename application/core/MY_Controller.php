<?php

class MY_ControllerLogin extends CI_Controller {
    function __construct()
    {
        parent::__construct();

        if (!($this->session->userdata('logado') == true && $this->session->userdata('administradorstatus') == 1)){

            redirect('/login');
        }

        if ($this->session->userdata('administradornivel') == 1) {
            $this->load->model('Chamados_model');
            $notificacao = array(
                'notificacao' => $this->Chamados_model->getNotificacaoAdmin()
            );
            $this->load->view('header', $notificacao);
        }

        if ($this->session->userdata('administradornivel') == 2) {
            $this->load->model('Chamados_model');
            $notificacao = array(
                'notificacao' => $this->Chamados_model->getNotificacaoUsuario($this->session->userdata('idadministrador'))
            );
            $this->load->view('header', $notificacao);
        }

    }

}