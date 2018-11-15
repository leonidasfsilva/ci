<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chamados_model extends CI_Model {

    function getTodosChamados(){
        $this->db
            ->order_by('idchamado', 'desc');
        return $this->db->get('chamados');
    }

    function getTodosStatus(){
        return $this->db->get('statuschamado');
    }

    function getTodosAdmins(){
        return $this->db->get('administrador');
    }

    function getChamado($idchamado){
        $idchamado = (int)$idchamado;
        return $this->db->query
        (
            sprintf(
                'SELECT idchamado, usuariochamado, titulochamado, descricaochamado, statuschamado
                        FROM chamados 
                        WHERE idchamado = %d', $idchamado)
        );
    }

    function getStatusChamadoById($idchamado){
        $idchamado = (int)$idchamado;
        $this->db->where('idstatuschamado', $idchamado);
        return $this->db->get('statuschamado');
    }

    function getStatusById($idchamado){
        $idchamado = (int)$idchamado;
        $this->db
            ->select('*')
            ->join('chamados as ch', 'ch.statuschamado_id = idstatuschamado')
            ->where('ch.idchamado', $idchamado);
        return $this->db->get('statuschamado');
    }

    function getSolicitanteChamado($idchamado){
        $idchamado = (int)$idchamado;
        $this->db
            ->select('administradornome as nome')
            ->join('chamados as ch', 'ch.administrador_id = administrador.idadministrador')
            ->where('ch.idchamado', $idchamado);
        return $this->db->get('administrador');
    }

    function getRespostaById($idchamado){
        $idchamado = (int)$idchamado;
        $this->db
            ->select('*')
            ->join('chamados as ch', 'ch.idchamado = respostachamado.chamado_id')
            ->where('ch.idchamado', $idchamado);
        return $this->db->get('respostachamado');
    }

    function getSolicitanteById($idchamado){
        $idchamado = (int)$idchamado;
        $this->db
            ->select('administradornome as nome')
            ->join('chamados as ch', 'ch.administrador_id = idadministrador')
            ->where('ch.idchamado', $idchamado);
        return $this->db->get('administrador');
    }
/*
    function getAssuntoById($idchamado){
        $idchamado = (int)$idchamado;
        $this->db
            ->select('assuntochamado as assunto')
            ->where('idchamado', $idchamado);
        return $this->db->get('chamados');
    }
*/
    function getDescricaoById($idchamado){
        $idchamado = (int)$idchamado;
        $this->db
            ->select('descricaochamado as descricao')
            ->where('idchamado', $idchamado);
        return $this->db->get('chamados');
    }

    function getAdminById($idchamado){
        $idchamado = (int)$idchamado;
        $this->db->where('administrador_id', $idchamado);
        return $this->db->get('chamados');
    }

    function getChamadoById($id){
        $this->db->where('idchamado', $id);
        return $this->db->get('chamados');
    }

    function getChamadoByUsuario($id){
        $this->db->order_by('idchamado', 'desc');
        $this->db->where('administrador_id', $id);
        $this->db->where('statuschamado_id' != 0);
        return $this->db->get('chamados');
    }

    function listarChamadosUsuario($id){
        return $this->db->query
        (
            sprintf(
                'SELECT *
                        FROM chamados 
                        WHERE statuschamado_id != 0 
                        and administrador_id = '.$id.
                        ' order by idchamado desc')
        );
    }

    function cadastraChamado($data){
        $this->db->insert('chamados', $data);
    }

    function respondeChamado($data){
        $this->db->insert('respostachamado', $data);
    }

    function atualizaChamado($id, $data){
        $this->db->where('idchamado', $id);
        $this->db->update('chamados', $data);
    }

    function modificaChamado($id, $data){
        $this->db->where('idchamado', $id);
        $this->db->update('chamados', $data);
    }

    function excluiChamado($id, $data){
        $this->db->where('idchamado', $id);
        $this->db->update('chamados', $data);
    }

    function getNotificacaoAdmin(){
        $this->db
            ->select('notifica_admin')
            ->where('notifica_admin', 1);
        return $this->db->get('chamados');
    }

    function getNotificacaoUsuario($id){
        $this->db
            ->select('notifica_usuario')
            ->where('notifica_usuario', 1)
            ->where('statuschamado_id !=', 0)
            ->where('administrador_id =', $id);
        return $this->db->get('chamados');
    }

    function getTodosAssuntos(){
        return $this->db->get('assunto_chamado');
    }

    function getAssuntoById($idchamado){
        $idchamado = (int)$idchamado;
        $this->db
            ->select('*')
            ->join('chamados as ch', 'ch.assunto_id = id_assunto')
            ->where('ch.idchamado', $idchamado);
        return $this->db->get('assunto_chamado');
    }

    function getTodosChamadosAbertos(){
        $this->db
            ->select('*')
            ->where('statuschamado_id', 1);
        return $this->db->get('chamados');
    }

    function getTodosChamadosEmAnalise(){
        $this->db
            ->select('*')
            ->where('statuschamado_id', 2);
        return $this->db->get('chamados');
    }

    function getTodosChamadosFinalizados(){
        $this->db
            ->select('*')
            ->where('statuschamado_id', 3);
        return $this->db->get('chamados');
    }

    function getTodosChamadosExcluidos(){
        $this->db
            ->select('*')
            ->where('statuschamado_id', 0);
        return $this->db->get('chamados');
    }
}