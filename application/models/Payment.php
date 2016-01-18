<?php
    class Payment extends CI_Model{
        
        var $table = 'payment';
        
        function __construct(){
            parent::__construct();
        }
        
        function get_payment_by_id($id){
            $this->db->select('*');
            $this->db->from($this->table);
            $this->db->where('payment_id', $id);
            $query = $this->db->get();
            return $query->row_array();
        }
        
        function get_payment_by_order_id($oid){
            $this->db->select('*');
            $this->db->from($this->table);
            $this->db->where('payment_order_id', $oid);
            $query = $this->db->get();
            return $query->row_array();
        }
        
        function get_payment($q=array()){
            $this->db->select('*');
            $this->db->from($this->table);
            $this->db->join('order', 'payment_order_id = order_id');
            $this->db->join('order_status', 'order_status_id = order_order_status_id');
            $this->db->join('bank', 'bank_id = payment_bank_id');
            $this->db->join('dealer', 'dealer_id = order_dealer_id');
            $this->db->where($q);
            $query = $this->db->get();
            return $query->row_array();
        }
        
        function list_payments($q=array(), $lim=0, $off=0, $type='arr', $sort='payment_order_id DESC'){
            $this->db->select('*');
            $this->db->from($this->table);
            $this->db->join('order', 'order_id = payment_order_id ', 'left');
            $this->db->join('order_status', 'order_status_id = order_order_status_id');
            $this->db->join('bank', 'bank_id = payment_bank_id');
            $this->db->join('dealer', 'dealer_id = order_dealer_id');
            $this->db->where($q);
            $this->db->limit($lim, $off);
            $this->db->order_by($sort);
            $query = $this->db->get();
            
            return Product::result_as($query, $type);
        }
        
        function list_banks($q=array(), $sort='bank_name ASC'){
            $this->db->select('*');
            $this->db->from('bank');
            $this->db->where($q);
            $this->db->order_by($sort);
            $query = $this->db->get();
            
            return $query->result_array();
        }
        
        function add($p_arr){
            $res = $this->db->insert($this->table, $p_arr);
            if($res){
                $data['id'] = $this->db->insert_id();
                return $data;
            }
            return NULL;
        }
        
        function remove($id){
            $this->db->where('payment_id', $id);
            $res = $this->db->delete($this->table);
            return $res;
        }
        
        function get_num_rows($q=array()){
            $this->db->where($q);
            $this->db->from($this->table);
            $this->db->join('order', 'order_id = payment_order_id ', 'left');
            $this->db->join('order_status', 'order_status_id = order_order_status_id');
            $this->db->join('bank', 'bank_id = payment_bank_id');
            $this->db->join('dealer', 'dealer_id = order_dealer_id');
            return $this->db->count_all_results();
        }
    }
    