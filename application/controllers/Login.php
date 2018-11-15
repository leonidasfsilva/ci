<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login extends CI_Controller {

    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->session->userdata('logado') == true && $this->session->userdata('administradorstatus') == 1)
        {
            redirect('/painel');

        } else {

            $this->load->view('login/login');
        }
    }

    public function entrar()
    {
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible small font-weight-bold" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="fa fa-times fa-fw"></i> ', '</div>');
        $this->form_validation->set_rules('usuarioemail', '"E-mail"', 'required');
        $this->form_validation->set_rules('usuariosenha', '"Senha"', 'required');


        if ($this->form_validation->run() == FALSE )
        {
            $this->index();
            return;
        }

        $usuarioemail = $this->input->post('usuarioemail');
        $usuariosenha = $this->input->post('usuariosenha');

        $this->db
            ->select('*')
            ->from('administrador')
            ->where('administradoremail', $usuarioemail)
            ->where('administradorsenha', sha1($usuariosenha));

        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            $result = $query->row();

            $this->session->set_userdata('idadministrador', $result->idadministrador);
            $this->session->set_userdata('administradornome', $result->administradornome);
            $this->session->set_userdata('administradoremail', $result->administradoremail);
            $this->session->set_userdata('administradorstatus', $result->statusadministrador_id);
            $this->session->set_userdata('administradornivel', $result->niveladministrador_id);


            if ($this->session->userdata('administradorstatus') == 2)
            {
                $this->session->set_flashdata('contaBloqueada','Conta bloqueada!');
                redirect('/login');
            }

            if ($this->session->userdata('administradorstatus') == 3)
            {
                $this->session->set_flashdata('contaDesativada','Conta desativada!');
                redirect('/login');

            } else {
                $this->session->set_userdata('logado', true);
                $this->session->set_flashdata('loginSuccess','Bem-vindo(a), '.$this->session->userdata('administradornome').'!');
                redirect('/painel');

            }

        } else {

            $this->session->set_flashdata('danger','Dados de acesso inválidos!');
            redirect('/login');

        }

    }

    public function sair()
    {
        $this->session->unset_userdata();
        $this->session->sess_destroy();
        $this->session->set_flashdata('success','Usuário desconectado com sucesso!');
        redirect('/login', ['desconectado' => true]);

    }

}
