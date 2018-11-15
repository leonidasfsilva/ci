<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin extends MY_ControllerLogin {

    public function index()
    {
        redirect('login');
    }

    public function cadastrar()
    {
        if ($this->session->userdata('administradornivel') == 1)
        {
            $this->load->view('admin/cadastrar_admin');
        } else {
            $this->session->set_flashdata('danger','Você não possui permissão para cadastrar novos usuários!');
            redirect('/painel');
        }

    }

    public function cadastraAdmin()
    {
        $administradornome = $this->input->post('administradornome');
        $administradoremail = $this->input->post('administradoremail');
        $administradorsenha = $this->input->post('administradorsenha');
        $administradorstatus = $this->input->post('administradorstatus');
        $administradornivel = $this->input->post('administradornivel');


        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <i class="fa fa-times-circle fa-lg fa-fw"></i><span class="small"> ', '</span></div>');
        $this->form_validation->set_rules('administradornome', 'Nome do administrador', 'required|max_length[120]');
        $this->form_validation->set_rules('administradoremail', 'E-mail', 'required');
        $this->form_validation->set_rules('administradorsenha', 'Senha', 'required|min_length[6]');
        $this->form_validation->set_rules('administradorstatus', 'Status', 'required');
        $this->form_validation->set_rules('administradornivel', 'Nível', 'required');


        if ($this->form_validation->run() == FALSE)
        {
            $this->cadastrar();
            return;
        }

        $this->load->model('Admin_model');
        $dados = array(
            "administradornome" => $administradornome,
            "administradoremail" => $administradoremail,
            "administradorsenha" => sha1($administradorsenha),
            "statusadministrador_id" => $administradorstatus,
            "niveladministrador_id" => $administradornivel

        );
        $this->Admin_model->cadastraAdmin($dados);
        $this->session->set_flashdata('success','Usuário cadastrado com sucesso!');
        redirect('admin/gerenciar');
    }

    public function MeusDados()
    {
        $idadministrador = (int)$this->session->userdata('idadministrador');
        $this->load->model('Admin_model');

        $data = array (
            'admin' => $this->Admin_model->getDadosAdminById($idadministrador)->row(),
            'status' => $this->Admin_model->getTodosStatus(),
            'nivel' => $this->Admin_model->getTodosNiveis()
        );

        $this->load->view('admin/meus_dados', $data);
    }

    public function alteraMeusDados()
    {
        $idadministrador = (int)$this->session->userdata('idadministrador');
        $administradornome = $this->input->post('administradornome');
        $administradoremail = $this->input->post('administradoremail');
        $administradorsenha = $this->input->post('administradorsenha');


        if ($this->input->post('administradorsenha') != null)
        {

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <i class="fa fa-times-circle fa-lg fa-fw"></i><span class="small"> ', '</span></div>');
            $this->form_validation->set_rules('administradornome', '"Nome do administrador"', 'required|max_length[120]');
            $this->form_validation->set_rules('administradoremail', '"E-mail"', 'required');
            $this->form_validation->set_rules('administradorsenha', '"Senha"', 'required|min_length[6]');

            if ($this->form_validation->run() == FALSE)
            {
                $this->MeusDados();
                return;
            }

            $this->load->model('Admin_model');
            $data = array(
                "administradornome" => $administradornome,
                "administradoremail" => $administradoremail,
                "administradorsenha" => sha1($administradorsenha)
            );

            $this->Admin_model->atualizaAdmin($idadministrador, $data);
            $this->session->set_flashdata('success','Cadastro atualizado com sucesso!');
            redirect('painel/');
        } else {

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <i class="fa fa-times-circle fa-lg fa-fw"></i><span class="small"> ', '</span></div>');
            $this->form_validation->set_rules('administradornome', '"Nome do administrador"', 'required|max_length[120]');
            $this->form_validation->set_rules('administradoremail', '"E-mail"', 'required');

            if ($this->form_validation->run() == FALSE)
            {
                $this->MeusDados();
                return;
            }

            $this->load->model('Admin_model');
            $data = array(
                "administradornome" => $administradornome,
                "administradoremail" => $administradoremail
            );

            $this->Admin_model->atualizaAdmin($idadministrador, $data);
            $this->session->set_flashdata('alert','Seu cadastro foi atualizado com sucesso!');
            redirect('painel/');
        }

    }

    public function alterarDados($idadministrador)
    {
        if ($this->session->userdata('administradornivel') != 1)
        {
            $this->session->set_flashdata('danger','Você não possui permissão para alterar dados de usuários!');
            redirect('/painel');
        } else {
            $idadministrador = (int)$idadministrador;
            $this->load->model('Admin_model');

            $data = array (
                'admin' => $this->Admin_model->getDadosAdminById($idadministrador)->row(),
                'status' => $this->Admin_model->getTodosStatus(),
                'nivel' => $this->Admin_model->getTodosNiveis()
            );

            $this->load->view('admin/alterar_dados', $data);
        }

    }

    public function alteraDadosAdmin($idadministrador)
    {
        $idadministrador = (int)$idadministrador;
        $administradornome = $this->input->post('administradornome');
        $administradoremail = $this->input->post('administradoremail');
        $administradorsenha = $this->input->post('administradorsenha');
        $administradorstatus = $this->input->post('statusadministrador_id');
        $administradornivel = $this->input->post('niveladministrador_id');

        if ($this->input->post('administradorsenha') != null)
        {

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <i class="fa fa-times-circle fa-lg fa-fw"></i><span class="small"> ', '</span></div>');
            $this->form_validation->set_rules('administradornome', '"Nome do administrador"', 'required|max_length[120]');
            $this->form_validation->set_rules('administradoremail', '"E-mail"', 'required');
            $this->form_validation->set_rules('statusadministrador_id', '"Status"', 'required');
            $this->form_validation->set_rules('niveladministrador_id', '"Nível"', 'required');
            $this->form_validation->set_rules('administradorsenha', '"Senha"', 'required|min_length[6]');

            if ($this->form_validation->run() == FALSE)
            {
                $this->alterarDados($idadministrador);
                return;
            }

            $this->load->model('Admin_model');
            $data = array(
                "administradornome" => $administradornome,
                "administradoremail" => $administradoremail,
                "statusadministrador_id" => $administradorstatus,
                "niveladministrador_id" => $administradornivel,
                "administradorsenha" => sha1($administradorsenha)
            );

            $this->Admin_model->atualizaAdmin($idadministrador, $data);
            $this->session->set_flashdata('success','Cadastro atualizado com sucesso!');
            redirect('painel');
        } else {

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <i class="fa fa-times-circle fa-lg fa-fw"></i><span class="small"> ', '</span></div>');
            $this->form_validation->set_rules('administradornome', '"Nome do administrador"', 'required|max_length[120]');
            $this->form_validation->set_rules('administradoremail', '"E-mail"', 'required');
            $this->form_validation->set_rules('statusadministrador_id', '"Status"', 'required');
            $this->form_validation->set_rules('niveladministrador_id', '"Nível"', 'required');

            if ($this->form_validation->run() == FALSE)
            {
                $this->alterarDados($idadministrador);
                return;
            }

            $this->load->model('Admin_model');
            $data = array(
                "administradornome" => $administradornome,
                "administradoremail" => $administradoremail,
                "niveladministrador_id" => $administradornivel,
                "statusadministrador_id" => $administradorstatus
            );

            $this->Admin_model->atualizaAdmin($idadministrador, $data);
            $this->session->set_flashdata('success','Cadastro atualizado com sucesso!');
            redirect('admin/gerenciar');
        }

    }

    public function alterarSenha()
    {
        $this->load->view('admin/alterar_senha');
    }

    public function alteraSenha()
    {
        $idadministrador = (int)$this->session->userdata('idadministrador');
        $novasenha = $this->input->post('novasenha');
        $confirmacaosenha = $this->input->post('confirmacaosenha');

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <i class="fa fa-times-circle fa-lg fa-fw"></i><span class="small"> ', '</span></div>');
        $this->form_validation->set_rules('novasenha', '"Nova senha"', 'min_length[6]');
        $this->form_validation->set_rules('confirmacaosenha', '"Confirmação de senha"', 'min_length[6]');

        if ($this->form_validation->run() == FALSE)
        {
            $this->alterarsenha();
            return;
        }

        if ($novasenha == $confirmacaosenha)
        {
            $this->load->model('Admin_model');
            $data = array(
                "administradorsenha" => sha1($confirmacaosenha)
            );

            $this->Admin_model->atualizaAdmin($idadministrador, $data);
            $this->session->set_flashdata('success','Sua senha foi alterada com sucesso!');
            redirect('painel');
        } else {

            $this->session->set_flashdata('danger','As senhas não correspondem!');
            redirect('admin/alterarsenha/');
        }


    }

    public function gerenciar()
    {
        if ($this->session->userdata('administradornivel') == 1)
        {
            $this->load->model('Admin_model');

            $data = array (
                "usuarios" => $this->Admin_model->getTodosAdmins(),
                "status" => $this->Admin_model->getTodosStatus(),
                "nivel" => $this->Admin_model->getTodosNiveis()
            );

            $this->load->view('admin/gerenciar_admins', $data);
        } else {
            $this->session->set_flashdata('danger','Você não possui permissão para gerenciar usuários!');
            redirect('/painel');
        }
    }

    public function excluir()
    {
        if ($this->session->userdata('administradornivel') == 1)
        {
            $idadministrador = $this->input->post('admin');
            $this->load->model('Admin_model');
            $this->Admin_model->excluiAdmin($idadministrador);

            $this->session->set_flashdata('success','Usuário excluído com sucesso!');
            redirect('admin/gerenciar');
        } else {
            $this->session->set_flashdata('danger','Você não possui permissão para excluir usuários!');
            redirect('/painel');
        }



    }


}