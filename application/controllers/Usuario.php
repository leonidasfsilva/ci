<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends MY_ControllerLogin {

	public function index($idcategoria)
	{
	    $idcategoria = (int)$idcategoria;
	    $this->load->model('Usuario_model');
	    $this->load->model('Categoria_model');

	    $data = array(
            "dadosCategoria" => $this->Categoria_model->getCategoria($idcategoria)->row(),
            "clientes" => $this->Usuario_model->getUsuariosIdCategoria($idcategoria)
        );

	    $this->load->view('usuarios_list_tpl', $data);
	}

	public function cadastrarUsuario($idcategoria)
    {
        $idcategoria = (int)$idcategoria;
        $this->load->model('Categoria_model');
        $data = array(
            "idcategoria" => $idcategoria,
            "categorias" => $this->Categoria_model->getAllCategorias()

        );
        $this->load->view('usuario_cadastro_tpl', $data);
    }

    public function cadastraUsuario()
    {
        $usuarionome = $this->input->post('usuarionome');
        $idcategoria = $this->input->post('idcategoria');
        $usuarioemail = $this->input->post('usuarioemail');

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <i class="fa fa-times fa-fw"></i> ', '</div>');
        $this->form_validation->set_rules('usuarionome', 'Nome do usuário', 'trim|required|max_length[120]');
        $this->form_validation->set_rules('usuarioemail', 'E-mail', 'required');
        $this->form_validation->set_rules('idcategoria', 'Categoria', 'trim|required|integer');

        if ($this->form_validation->run() == FALSE)
        {
            $this->cadastrarUsuario($idcategoria);
            return;
        }

        $this->load->model('Usuario_model');
        $dados = array(
            "usuarionome" => $usuarionome,
            "usuarioemail" => $usuarioemail,
            "categoria_idcategoria" => $idcategoria
        );
        $this->Usuario_model->cadastraUsuario($dados);

        $this->session->set_flashdata('success','Usuário cadastrado com sucesso!');
        redirect('usuario/index/'.$idcategoria);
    }

    public function excluirUsuario()
    {
        $idcategoria = $this->input->post('categoria');
        $idusuario = $this->input->post('usuario');
        $this->load->model('Usuario_model');
        $this->Cliente_model->excluiUsuario($idusuario);

        $this->session->set_flashdata('success','Usuário excluído com sucesso!');
        redirect('usuario/index/'.$idcategoria);
    }

    public function alterarUsuario($idusuario)
    {
        $idusuario = (int)$idusuario;
        $this->load->model('Usuario_model');
        $this->load->model('Categoria_model');

        $data = array (
            "dadosUsuario" => $this->Usuario_model->getUsuario($idusuario)->row(),
            "categorias" => $this->Categoria_model->getAllCategorias()

        );

        $this->load->view('usuario_alterar_tpl', $data);
    }

    public function alteraUsuario($idusuario)
    {
        $idusuario = (int)$idusuario;
        $usuarionome = $this->input->post('usuarionome');
        $idcategoria = $this->input->post('idcategoria');
        $usuarioemail = $this->input->post('usuarioemail');

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <i class="fa fa-times fa-fw"></i> ', '</div>');
        $this->form_validation->set_rules('usuarionome', 'Nome do usuário', 'trim|required|max_length[120]');
        $this->form_validation->set_rules('usuarioemail', 'E-mail', 'required');
        $this->form_validation->set_rules('idcategoria', 'Categoria', 'trim|required|integer');

        if ($this->form_validation->run() == FALSE)
        {
            $this->alterarUsuario($idusuario);
            return;
        }

        $this->load->model('Usuario_model');
        $data = array(
            "usuarionome" => $usuarionome,
            "usuarioemail" => $usuarioemail,
            "categoria_idcategoria" => $idcategoria
        );
        $this->Usuario_model->atualizaUsuario($idusuario, $data);

        $this->session->set_flashdata('success','Usuário alterado com sucesso!');
        redirect('usuario/index/'.$idcategoria);
    }

}
