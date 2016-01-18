<?php
    class Bank extends CI_Model{
        
        function __construct(){
            parent::__construct();
        }
        
        function get_bank_by_id($id){
            $this->db->select('*');
            $this->db->from('bank');
            $this->db->where('bank_id', $id);
            $this->db->where('bank_status', 1);
            $query = $this->db->get();
            return $query->row_array();
        }
        
        function list_banks($q=array(), $sort='bank_name ASC'){
            $this->db->select('*');
            $this->db->from('bank');
            $this->db->where('bank_status', 1);
            $this->db->where($q);
            $this->db->order_by($sort);
            $query = $this->db->get();
            
            return $query->result_array();
        }
        
        function add($arr){
            $res = $this->db->insert('bank', $arr);
            return $res;
        }
        
        function edit($id, $arr){
            $this->db->set($arr);
            $this->db->where('bank_id', $id);
            $res = $this->db->update('bank');
            return $res;
        }
        
        function remove($id){
            $this->db->set('bank_status', 0);
            $this->db->where('bank_id', $id);
            return $res = $this->db->update('bank');
        }
    }
    