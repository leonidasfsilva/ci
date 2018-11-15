<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model {

    function getTodosUsuarios(){
        return $this->db->get('usuario');
    }

    function getUsuariosIdCategoria($idcategoria){
        $this->db->where('categoria_idcategoria', $idcategoria);
        return $this->db->get('usuario');
    }

    function getUsuario($idusuario){
        $idusuario = (int)$idusuario;
        return $this->db->query
        (
            sprintf(
                'SELECT idusuario, usuarionome, usuarioemail, categoria_idcategoria
                        FROM usuario 
                        WHERE idusuario = %d', $idusuario)
        );
    }

    function getUsuarioByDb($idusuario){
        $idusuario = (int)$idusuario;
        $query = array(
            'idusuario' => $idusuario,
            'status' => 1
        );
        $this->db->where($query);
        return $this->db->get('usuario');
    }

    function cadastraUsuario($data){
        $this->db->insert('usuario', $data);

    }

    function atualizaUsuario($id, $data){
        $this->db->where('idusuario', $id);
        $this->db->update('usuario', $data);
    }

    function excluiUsuario($id){
        $this->db->where('idusuario', $id);
        $this->db->delete('usuario');

    }

}