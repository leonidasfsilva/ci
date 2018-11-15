<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Painel extends MY_ControllerLogin {

    public function index()
    {

        $this->load->model('Usuario_model');
        $this->load->model('Categoria_model');
        $this->load->model('Chamados_model');
        $data = array(
            'categorias' => $this->Categoria_model->getAllCategorias(),
            'usuarios' => $this->Usuario_model->getTodosUsuarios(),
            'notifica_admin' => $this->Chamados_model->getNotificacaoAdmin(),
            'notifica_usuario' => $this->Chamados_model->getNotificacaoUsuario($this->session->userdata('idadministrador'))

        );

        $this->load->view('painel_tpl', $data);
    }

    public function exibirCategorias()
    {
        $this->load->model('Categoria_model');
        $data = array(
            "categorias" => $this->Categoria_model->getAllCategorias(),
        );

        $this->load->view('categorias_list_tpl', $data);
    }

    public function cadastrarCategoria()
    {
        $this->load->view('categorias_cadastro_tpl');
    }

    public function cadastraCategoria()
    {
        $categoriatitulo = $this->input->post('categoriatitulo');

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <i class="fa fa-times fa-fw"></i> ', '</div>');
        $this->form_validation->set_rules('categoriatitulo', 'Título da categoria', 'required|max_length[40]');

        if ($this->form_validation->run() == FALSE)
        {
            $this->cadastrarCategoria();
            return;
        }

        $this->load->model('Categoria_model');
        $dados = array(
            "categoriatitulo" => $categoriatitulo
        );
        $this->Categoria_model->cadastraCategoria($dados);
        $this->session->set_flashdata('success','Categoria adicionada com sucesso!');
        redirect('painel/');

    }

    public function alterarCategoria($idcategoria)
    {
        // carrega o model da categoria
        $this->load->model('Categoria_model');
        // pega o ID da categoria que está sendo alterada
        $idcategoria = (int)$idcategoria;
        // pega os dados da categoria que será alterada
        $data = array(
            'dadosCategoria' => $this->Categoria_model->getCategoria($idcategoria)->row()

        );

        $this->load->view('categorias_alterar_tpl', $data);
    }

    public function alteraCategoria($idcategoria)
    {
        $this->load->model('Categoria_model');
        $idcategoria = (int)$idcategoria;
        $categoriatitulo = $this->input->post('categoriatitulo');

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger text-center">', '</div>');
        $this->form_validation->set_rules('categoriatitulo', 'Título da categoria', 'required|max_length[40]');

        if ($this->form_validation->run() == FALSE)
        {
            $this->alterarCategoria($idcategoria);
            return;
        }

        // executar o update na base de dados
        $dados = array(
            "categoriatitulo" => $categoriatitulo
        );
        $this->Categoria_model->atualizaCategoria($idcategoria, $dados);
        $this->session->set_flashdata('success','Categoria atualizada com sucesso!');
        redirect('painel/');
    }

    public function excluirCategoria()
    {
        $idcategoria = $this->input->post('categoria');
        $this->load->model('Usuario_model');
        $usuarios = $this->Usuario_model->getUsuariosIdCategoria($idcategoria);

        if($usuarios->num_rows() > 0)
        {
            $this->session->set_flashdata('error','Esta categoria não pôde ser excluída, pois possui registros cadastrados!');
            redirect('painel/');
        } else {
            $this->load->model('Categoria_model');
            $this->Categoria_model->deletaCategoria($idcategoria);
            $this->session->set_flashdata('success','Categoria excluída com sucesso!');
            redirect('painel/');
        }
    }

    public function teste()
    {
        $teste = $this->input->post('usuarioemail');

        $data = array(
            'teste' => $teste
        );
        $this->load->view('teste', $data);
    }
}
?>
<?php
   function programmer() {
       while ($awake == true) {
           code();
       }
   }
?>