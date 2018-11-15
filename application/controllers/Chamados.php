<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class chamados extends MY_ControllerLogin {

    public function index()
    {
        if ($this->session->userdata('administradornivel') == 1) {
            $this->load->model('Chamados_model');

            $data = array (
                'chamados' => $this->Chamados_model->getTodosChamados(),
                'chamados_abertos' => $this->Chamados_model->getTodosChamadosAbertos(),
                'chamados_analisados' => $this->Chamados_model->getTodosChamadosEmAnalise(),
                'chamados_finalizados' => $this->Chamados_model->getTodosChamadosFinalizados(),
                'chamados_excluidos' => $this->Chamados_model->getTodosChamadosExcluidos(),
                'status' => $this->Chamados_model->getTodosStatus(),
                'admin' => $this->Chamados_model->getTodosAdmins(),
                'assunto' => $this->Chamados_model->getTodosAssuntos()
            );

            $this->load->view('chamados/gerenciar_chamados', $data);

        } elseif ($this->session->userdata('administradornivel') == 2) {

            $idusuario = $this->session->userdata('idadministrador');

            $this->load->model('Chamados_model');

            $data1 = array (
                'chamados' => $this->Chamados_model->listarChamadosUsuario($idusuario),
                'status' => $this->Chamados_model->getTodosStatus(),
                'admin' => $this->Chamados_model->getTodosAdmins(),
                'assunto' => $this->Chamados_model->getTodosAssuntos()
            );
            $this->load->view('chamados/listar_chamados_usuario', $data1);

        } else {
            $this->session->set_flashdata('danger','Você não possui permissão para visualizar chamados!');
            redirect('/painel');
        }

    }

    public function registrar()
    {
        $this->load->model('Chamados_model');
        if ($this->session->userdata('administradornivel') == 1 || $this->session->userdata('administradornivel') == 2)
        {
            $data = array (
                'assunto' => $this->Chamados_model->getTodosAssuntos()
            );

            $this->load->view('chamados/cadastrar_chamados', $data);
        } else {
            $this->session->set_flashdata('danger','Você não possui permissão para abrir chamados!');
            redirect('/painel');
        }

    }

    public function cadastraChamado()
    {
        $idusuario = $this->input->post('idusuario');
        $assuntochamado = $this->input->post('assuntochamado');
        $descricaochamado = $this->input->post('descricaochamado');
        $statuschamado = $this->input->post('statuschamado');


        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <i class="fa fa-times fa-fw"></i> ', '</div>');
        $this->form_validation->set_rules('assuntochamado', 'Assunto', 'required');
        $this->form_validation->set_rules('descricaochamado', 'Descrição', 'max_length[255]');

        if ($this->form_validation->run() == FALSE)
        {
            $this->registrar();
            return;
        }


        $this->load->model('Chamados_model');
        $dados = array(
            'assunto_id' => $assuntochamado,
            'descricaochamado' => $descricaochamado,
            'administrador_id' => $idusuario,
            'statuschamado_id' => $statuschamado,
            'notifica_admin' => 1

        );
        $this->Chamados_model->cadastraChamado($dados);
        $this->session->set_flashdata('success','Chamado registrado com sucesso!');
        redirect('painel');
    }

    public function detalhar($idchamado)
    {
        if ($this->session->userdata('administradornivel') == 1) {

            $idchamado = (int)$idchamado;

            $this->load->model('Chamados_model');

            $data = array (
                'chamado' => $this->Chamados_model->getChamadoById($idchamado)->row(),
                'status' => $this->Chamados_model->getStatusById($idchamado)->row(),
                'admin' => $this->Chamados_model->getSolicitanteChamado($idchamado)->row(),
                'resposta' => $this->Chamados_model->getRespostaById($idchamado),
                'assunto' => $this->Chamados_model->getAssuntoById($idchamado)->row()
            );
            $this->load->view('chamados/detalhes_chamados', $data);

            $dados2 = array(
                'notifica_admin' => 0
            );
            $this->Chamados_model->modificaChamado($idchamado, $dados2);

        }

        elseif ($this->session->userdata('administradornivel') == 2) {

            $idchamado = (int)$idchamado;

            $this->load->model('Chamados_model');

            $data = array (
                'chamado' => $this->Chamados_model->getChamadoById($idchamado)->row(),
                'status' => $this->Chamados_model->getStatusById($idchamado)->row(),
                'admin' => $this->Chamados_model->getSolicitanteChamado($idchamado)->row(),
                'resposta' => $this->Chamados_model->getRespostaById($idchamado),
                'assunto' => $this->Chamados_model->getAssuntoById($idchamado)->row()
            );
            $this->load->view('chamados/detalhes_chamados', $data);

            $dados2 = array(
                'notifica_usuario' => 0
            );
            $this->Chamados_model->modificaChamado($idchamado, $dados2);

        } else {
            $this->session->set_flashdata('danger','Você não possui permissão para gerenciar chamados!');
            redirect('/painel');
        }
    }
/*
    public function _responder($idchamado)
    {
        if (($this->session->userdata('administradornivel') == 1) || ($this->session->userdata('administradornivel') == 2))
        {
            $idchamado = (int)$idchamado;

            $this->load->model('Chamados_model');

            $data = array (
                'chamado' => $this->Chamados_model->getChamadoById($idchamado)->row(),
                'status' => $this->Chamados_model->getTodosStatus(),
                'nomestatus' => $this->Chamados_model->getStatusById($idchamado)->row('status'),
                'nome' => $this->Chamados_model->getSolicitanteById($idchamado)->row('nome'),
                'assunto' => $this->Chamados_model->getAssuntoById($idchamado)->row('assunto'),
                'descricao' => $this->Chamados_model->getDescricaoById($idchamado)->row('descricao'),
                'idchamado' => $idchamado
            );
            $this->load->view('chamados/responder_chamados', $data);

        } else {
            $this->session->set_flashdata('danger','Você não possui permissão para responder chamados!');
            redirect('/chamados');
        }
    }
*/
    public function respondeChamado()
    {
        $respostachamado = $this->input->post('respostachamado');
        $nomeusuario = $this->input->post('nomeusuario');
        $idchamado = $this->input->post('idchamado');


        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <i class="fa fa-times fa-fw"></i> ', '</div>');
        $this->form_validation->set_rules('respostachamado', '"Resposta"', 'required|max_length[255]');

        if ($this->form_validation->run() == FALSE)
        {
            $this->detalhar($idchamado);
            return;
        }

        $this->load->model('Chamados_model');

        if ($this->session->userdata('administradornivel') == 1) {
            $dados1 = array(
                'descricaoresposta' => $respostachamado,
                'chamado_id' => $idchamado,
                'nomeusuario' => $nomeusuario
            );

            $dados2 = array(
                'notifica_usuario' => 1
            );
        }
        if ($this->session->userdata('administradornivel') == 2) {
            $dados1 = array(
                'descricaoresposta' => $respostachamado,
                'chamado_id' => $idchamado,
                'nomeusuario' => $nomeusuario
            );

            $dados2 = array(
                'notifica_admin' => 1
            );
        }
        $this->Chamados_model->respondeChamado($dados1);
        $this->Chamados_model->modificaChamado($idchamado, $dados2);
        $this->session->set_flashdata('success','Resposta enviada com sucesso!');
        redirect('chamados/detalhar/'.$idchamado);
    }

    public function finalizar()
    {
        $idchamado = $this->input->post('idchamado');
        $statuschamado = $this->input->post('statuschamado');

        if ($statuschamado == 3)
        {
            $this->load->model('Chamados_model');
            $dados = array(
                'statuschamado_id' => $statuschamado

            );
            $this->Chamados_model->modificaChamado($idchamado, $dados);
            $this->session->set_flashdata('success','Chamado finalizado com sucesso!');
            redirect('chamados');
        }
        if ($statuschamado == 2)
        {
            $this->load->model('Chamados_model');
            $dados = array(
                'statuschamado_id' => $statuschamado

            );
            $this->Chamados_model->modificaChamado($idchamado, $dados);
            $this->session->set_flashdata('success','Chamado posto em análise com sucesso!');
            redirect('chamados');
        }

    }

    public function exemplo($idchamado)
    {
        if ($this->session->userdata('administradornivel') == 1 || $this->session->userdata('administradornivel') == 2)
        {
            $idusuario = $this->session->userdata('idadministrador');

            $this->load->model('Chamados_model');

            $data = array (
                'chamado' => $this->Chamados_model->getChamadoByUsuario($idusuario),
                'status' => $this->Chamados_model->getStatusById($idchamado)->row('status'),
                'nome' => $this->Chamados_model->getSolicitanteById($idchamado)->row('nome'),
                'assunto' => $this->Chamados_model->getAssuntoById($idchamado)->row('assunto'),
                'descricao' => $this->Chamados_model->getDescricaoById($idchamado)->row('descricao')
            );

            $this->load->view('chamados/exemplo_chamados', $data);
        } else {
            $this->session->set_flashdata('danger','Você não possui permissão para exemplificar chamados!');
            redirect('/painel');
        }

    }

    public function excluir()
    {
        if ($this->session->userdata('administradornivel') == 2)
        {
            $idchamado = $this->input->post('chamado');
            $this->load->model('Chamados_model');
            $dados = array(
                'idchamado' => $idchamado,
                'statuschamado_id' => 0

            );
            $this->Chamados_model->modificaChamado($idchamado, $dados);
            $this->session->set_flashdata('success','Chamado excluído com sucesso!');
            redirect('chamados');

        } else {
            $this->session->set_flashdata('error','Você não possui permissão para excluir chamados!');
            redirect('chamados');
        }



    }


}