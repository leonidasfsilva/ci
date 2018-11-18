<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model
{

    function getTodosAdmins()
    {
        return $this->db->get('administrador');
    }

    function getTodosStatus()
    {
        return $this->db->get('statusadministrador');
    }

    function getTodosNiveis()
    {
        return $this->db->get('niveladministrador');
    }

    function getAdmin($idadministrador)
    {
        $idadministrador = (int)$idadministrador;
        return $this->db->query
        (
            sprintf(
                'SELECT idadministrador, administradornome, administradoremail, administradorstatus
                        FROM administrador 
                        WHERE idadministrador = %d', $idadministrador)
        );
    }

    function getStatusAdmin($idcategoria)
    {
        $idcategoria = (int)$idcategoria;
        $this->db->where('idcategoria', $idcategoria);
        return $this->db->get('categoria');

    }

    function getStatusAdminById($idadministrador)
    {
        $idadministrador = (int)$idadministrador;
        $this->db
            ->select('descricaostatus as status')
            ->from('statusadministrador as st')
            ->join('administrador as ad', 'ad.statusadministrador_id = st.idstatusadministrador')
            ->where('ad.idadministrador', $idadministrador);
        return $this->db->get();
    }

    function getDadosAdminByEmail($administradoremail)
    {
        $this->db->where('administradoremail', $administradoremail);
        return $this->db->get('administrador');
    }

    function getDadosAdminById($idadministrador)
    {
        $this->db->where('idadministrador', $idadministrador);
        return $this->db->get('administrador');
    }

    function cadastraAdmin($data)
    {
        $this->db->insert('administrador', $data);
    }

    function atualizaAdmin($id, $data)
    {
        $this->db->where('idadministrador', $id);
        $this->db->update('administrador', $data);
    }

    function excluiAdmin($id)
    {
        $this->db->where('idadministrador', $id);
        $this->db->delete('administrador');
    }

    function gravaToken($data)
    {
        $this->db->insert('recuperacao_senha', $data);
    }

    function validaTokenById($id)
    {
        $this->db
            ->where('id_recuperacao_senha', $id)
            ->where('status', 1);
        return $this->db->get('recuperacao_senha');
    }

    function verificaValidadeToken($id)
    {
        $this->db
            ->select('*, TIMESTAMPDIFF(MINUTE , data_solicitacao, CURRENT_TIMESTAMP) AS validade')
            ->where('id_recuperacao_senha', $id);
        return $this->db->get('recuperacao_senha');
    }

    function apagaToken($id)
    {
        $this->db->where('id_recuperacao_senha', $id);
        $this->db->delete('recuperacao_senha');
    }

    function invalidaToken($id)
    {
        $this->db
            ->set('status', 0)
            ->where('id_recuperacao_senha', $id)
            ->update('recuperacao_senha');
    }

}