<?php
    class Order_status extends CI_Model{
        
        var $table = 'order_status';
        
        function __construct(){
            parent::__construct();
        }
        
        function list_order_status($q=array(), $type='arr'){
            $this->db->select('*');
            $this->db->from($this->table);
            $this->db->where($q);
            $this->db->order_by('order_status_sort', 'ASC');
            $query = $this->db->get();
            
            return Product::result_as($query, $type);
        }
    }
    