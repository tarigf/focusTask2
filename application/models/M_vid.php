<?php
class M_vid extends CI_Model{

    function find_data($where, $table){
        $this->db->limit(1);
        return $this->db->get_where($table,$where)->result_array();
    }
    
    function get_data($table){
       // $this->db->limit(1);
        return $this->db->get($table)->result_array();
    }
    
    function insert_data($data, $table){
        $this->db->insert($table, $data);
    }
    
    function update_data($where, $data, $table){
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    
    function delete_data($where, $table){
        $this->db->where($where);
        $this->db->delete($table);
    }
}