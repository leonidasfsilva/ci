<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria_model extends CI_Model {

    function getAllCategorias(){
        return $this->db->get('categoria');
    }

    function getCategoria($idcategoria){
        $idcategoria = (int)$idcategoria;
        $this->db->where('idcategoria', $idcategoria);
        return $this->db->get('categoria');

    }

    function cadastraCategoria($data){
        $this->db->insert('categoria', $data);

    }

    function atualizaCategoria($id, $data){
        $this->db->where('idcategoria', $id);
        $this->db->update('categoria', $data);
    }

    function deletaCategoria($id){
        $this->db->where('idcategoria', $id);
        $this->db->delete('categoria');

    }


}