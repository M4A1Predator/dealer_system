<?php
    class Level extends CI_Model{
        function __construct(){
            parent::__construct();
        }
        
        function get_level($q){
            $this->db->select('*');
            $this->db->where($q);
            $query = $this->db->get('level');
            
            return $query->row_array();
        }
        
        function list_levels($q=array()){
            $this->db->select('level_id, level_name');
            $this->db->where($q);
            $this->db->where('level_order >', 0);
            $this->db->order_by('level_order asc');
            $query = $this->db->get('level');
            
            return $query->result_array();
        }
        
        function list_all_levels($q=array()){
            $this->db->select('level_id, level_name');
            $this->db->where($q);
            $this->db->order_by('level_order asc');
            $query = $this->db->get('level');
            
            return $query->result_array();
        }
        
        function get_num_rows($q=array()){
            $query = $this->db->get_where('level', $q);
            return $query->num_rows();
        }
        
        function add($arr){
            return $res = $this->db->insert('level', $arr);
        }
    }
    