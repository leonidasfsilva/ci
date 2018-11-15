<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class redefinirsenha extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        redirect(site_url('/login'));
    }

    public function gerarToken()
    {
        $this->load->model('Admin_model');
        $usuarioemail = $this->input->post('usuarioemail');

        if (isset($usuarioemail)) {
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible small font-weight-bold" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="fa fa-times fa-fw"></i> ', '</div>');
            $this->form_validation->set_rules('usuarioemail', '"E-mail"', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->index();
                return;
            }

            $query = $this->Admin_model->getDadosAdminByEmail($usuarioemail);

            if ($query->num_rows() > 0) {
                $result = $query->row();

                $data = array(
                    'token' => sha1($result->idadministrador . $result->administradorsenha),
                    'email' => $result->administradoremail,
                    'id' => $result->idadministrador,
                    'status' => true
                );

                echo json_encode($data, JSON_PRETTY_PRINT);

            } else {

                $data = array(
                    'status' => false,
                    'email' => $usuarioemail
                );

                echo json_encode($data, JSON_PRETTY_PRINT);
            }
        } else {
            redirect(site_url('/login'), 'refresh');
        }

    }

    public function verificarToken()
    {
        $this->load->model('Admin_model');
        $tokenUsuario = $this->input->get('token');
        $idusuario = $this->input->get('id');

        if ($idusuario != null) {
            $query = $this->Admin_model->getDadosAdminById($idusuario);

            if ($query->num_rows() > 0) {
                $result = $query->row();
                $tokenReal = sha1($result->idadministrador . $result->administradorsenha);

                if ($tokenUsuario != null && $tokenUsuario == $tokenReal) {
                    $data = array(
                        'id' => $result->idadministrador,
                        'nome' => $result->administradornome,
                        'token' => $tokenReal
                    );

                    $this->load->view('redefinirsenha/alterar_senha', $data);

                } else {
                    $data2 = array(
                        'tokenInvalido' => true
                    );
                    $this->load->view('login/login', $data2);
                }
            } else {
                $data = array(
                    'tokenInvalido' => true
                );
                $this->load->view('login/login', $data);
            }
        } else {
            $data = array(
                'tokenInvalido' => true
            );
            $this->load->view('login/login', $data);
        }

    }

    public function alterarSenha()
    {
        $this->load->model('Admin_model');
        $idusuario = (int)$this->input->post('id');
        $token = $this->input->post('token');
        $novasenha = $this->input->post('novasenha');
        $repitasenha = $this->input->post('repitasenha');

        if (($token != null) && ($idusuario != null)) {
            $query = $this->Admin_model->getDadosAdminById($idusuario);
            $result = $query->row();
            $tokenReal = sha1($result->idadministrador . $result->administradorsenha);

            if ($tokenReal == $token) {
                $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible small font-weight-bold" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> ', '</div>');
                $this->form_validation->set_rules('novasenha', '"Nova senha"', 'required|min_length[6]');
                $this->form_validation->set_rules('repitasenha', '"Confirme nova senha"', 'required|min_length[6]');

                if ($this->form_validation->run() == FALSE) {
                    $data = array(
                        'id' => $result->idadministrador,
                        'nome' => $result->administradornome,
                        'token' => $token
                    );
                    $this->load->view('redefinirsenha/alterar_senha', $data);

                } else {

                    if (($novasenha != null) && ($repitasenha != null) && ($novasenha == $repitasenha)) {
                        $data1 = array(
                            'administradorsenha' => sha1($repitasenha)
                        );

                        $data2 = array(
                            'id' => $result->idadministrador,
                            'nome' => $result->administradornome,
                            'senhaAlterada' => true
                        );

                        $this->Admin_model->atualizaAdmin($idusuario, $data1);

                        $this->load->view('login/login', $data2);

                    } elseif (($novasenha != null) && ($repitasenha != null) && ($novasenha != $repitasenha)) {
                        $data3 = array(
                            'id' => $result->idadministrador,
                            'nome' => $result->administradornome,
                            'token' => $token,
                            'senhaAlterada' => false
                        );
                        $this->load->view('redefinirsenha/alterar_senha', $data3);

                    } else {
                        $data = array(
                            'tokenInvalido' => true
                        );
                        $this->load->view('login/login', $data);
                    }
                }
            }
        } else {
            $data = array(
                'tokenInvalido' => true
            );
            $this->load->view('login/login', $data);
        }
    }

}
