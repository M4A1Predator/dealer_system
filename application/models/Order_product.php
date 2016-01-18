<?php
    class Order_product extends CI_Model{
        
        var $table = 'order_product';
        var $view = 'view_order_product';
        
        function __construct(){
            parent::__construct();
        }
        
        function list_order_products($q=array(), $type='arr', $order=NULL, $op='ASC'){
            $this->db->select('*');
            $this->db->from($this->table);
            $this->db->where($q);
            $query = $this->db->get();
            
            return Product::result_as($query, $type);
        }
        
        function list_order_products_view($q=array(), $type='arr', $order=NULL, $op='ASC'){
            $this->db->select('*');
            $this->db->from($this->view);
            $this->db->where($q);
            $query = $this->db->get();
            
            return Product::result_as($query, $type);
        }
        
        function add($arr){
            $res = $this->db->insert($this->table, $arr);
            if($res){
                $data['id'] = $this->db->insert_id();
                return $data;
            }
            return NULL;
        }
        
        function remove_by_order($oid){
            $this->db->where('order_product_order_id', $oid);
            return $res = $this->db->delete($this->table);
        }
    }
    