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
        //$this->load->view('redefinirsenha/esqueceu_sua_senha');
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

                $token = sha1(uniqid(rand(), true));

                $data = array(
                    'token' => $token,
                    'email_usuario' => $result->administradoremail,
                    'id_usuario' => $result->idadministrador
                );

                $this->Admin_model->gravaToken($data);
                $last_id = $this->db->insert_id();

                $ajax = array(
                    'token' => $token,
                    'email' => $result->administradoremail,
                    'id' => $last_id,
                    'validacao' => true
                );

                //aqui entra o MAIL() para enviar o link de recuperação com o token gerado para o usuário


                $link = site_url('redefinirsenha/verificacao?token='.$token.'&id='.$last_id);
                $date = date("d/m/Y h:i");
                $ip = getenv("REMOTE_ADDR");
                $navegador = $_SERVER['HTTP_USER_AGENT'];
                $nomeremetente = $result->administradornome;
                $emailremetente = $result->administradoremail;

                //AUTO RESPOSTA
                $headers_ = "MIME-Version: 1.0\r\n";
                $headers_ .= "Content-type: text/html; charset=utf-8\r\n";
                $headers_ .= "From: naoresponda@mxcode.net\r\n";
                $assunto_resposta = "Redefinição de senha";

                $msg_resposta = '
                <p>Olá, ' . $nomeremetente . '!</p>
                <p>Recebemos um pedido para alteração de sua senha de cadastro em nosso sistema.
                <br />
                Origem da solicitação:
                <br />
                IP: '.$ip.'
                <br />
                Navegador: '.$navegador.'
                <br />
                Data e hora: '.$date.'
                <br />
                <br />
                Caso você tenha solicitado a troca de sua senha, segue o link para redefinir sua senha:
                <br />
                <br />
                <a href="'.$link.'" target="_blank"><strong>Clique aqui para redefinir sua senha</strong></a>
                <br />
                <p>Por questões de segurança, este link só estará válido por alguns minutos, caso seu link tenha expirado, faça uma nova solicitação clicando no botão <strong>Esqueci minha senha</strong></a> na página inicial do sistema.
                <br />
                Caso não tenha solicitado a troca de sua senha, por favor, desconsidere este email, nenhuma outra ação é necessária. Não se preocupe, sua conta está segura.
                <br />
                <p>Caso necessite de suporte específico, contate-nos em <a href="mailto:suporte@mxcode.net?Subject=Solicitação de suporte" target="_top"><strong>suporte@mxcode.net</strong></a>
                <br />
                <p>Atenciosamente,</p>
                <h3><strong>Equipe MX Code Sistemas.</strong></h3>
                <a href="https://mxcode.net" target="_blank"><strong>https://mxcode.net</strong></a><br />
                <br />_________________________________________________________________________
                <br />
                Não é necessário responder este e-mail, mensagem automática.';

                mail($emailremetente, $assunto_resposta, $msg_resposta, $headers_);

                //por hora, para efeito de teste, estou retornando o token para o aJax
                echo json_encode($ajax, JSON_PRETTY_PRINT);

            } else {

                $data = array(
                    'validacao' => false,
                    'email' => $usuarioemail
                );

                echo json_encode($data, JSON_PRETTY_PRINT);
            }
        } else {
            redirect(site_url('/login'), 'refresh');
        }

    }

    public function verificacao()
    {
        $this->load->model('Admin_model');
        $tokenUsuario = $this->input->get('token');
        $id = $this->input->get('id');

        if ($id != null) {
            $query = $this->Admin_model->validaTokenById($id);

            if ($query->num_rows() > 0) {
                $result = $query->row();
                $tokenReal = $result->token;

                if ($tokenUsuario != null && $tokenUsuario == $tokenReal) {

                    $query = $this->Admin_model->verificaValidadeToken($id);
                    $result = $query->row();

                    //tempo de validade do link
                    $validade = 20;

                    if ($result->validade < $validade) {

                        $qr = $this->Admin_model->getDadosAdminById($result->id_usuario);
                        $rs = $qr->row();

                        $data = array(
                            'id' => $id,
                            'nome' => $rs->administradornome,
                            'data' => $result->data_solicitacao,
                            'token' => $tokenReal
                        );

                        $this->load->view('redefinirsenha/alterar_senha', $data);

                    } else {

                        $data = array(
                            'tokenExpirado' => true
                        );
                        $this->load->view('login/login', $data);
                        $this->Admin_model->invalidaToken($id);
                    }

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
        $id = (int)$this->input->post('id');
        $token = $this->input->post('token');
        $novasenha = $this->input->post('novasenha');
        $repitasenha = $this->input->post('repitasenha');

        if (($token != null) && ($id != null)) {

            $queryToken = $this->Admin_model->validaTokenById($id);
            $resultToken = $queryToken->row();
            $tokenReal = $resultToken->token;

            if ($tokenReal == $token) {
                $this->form_validation->set_error_delimiters('<div class="alert alert-danger alert-dismissible small font-weight-bold" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> ', '</div>');
                $this->form_validation->set_rules('novasenha', '"Nova senha"', 'required|min_length[6]');
                $this->form_validation->set_rules('repitasenha', '"Confirme nova senha"', 'required|min_length[6]');

                $query = $this->Admin_model->getDadosAdminById($resultToken->id_usuario);
                $result = $query->row();

                if ($this->form_validation->run() == FALSE) {
                    $data = array(
                        'id' => $id,
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
                            'id' => $id,
                            'nome' => $result->administradornome,
                            'senhaAlterada' => true
                        );

                        $this->Admin_model->atualizaAdmin($resultToken->id_usuario, $data1);
                        $this->Admin_model->invalidaToken($id);

                        $this->load->view('login/login', $data2);

                    } elseif (($novasenha != null) && ($repitasenha != null) && ($novasenha != $repitasenha)) {
                        $data3 = array(
                            'id' => $id,
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
