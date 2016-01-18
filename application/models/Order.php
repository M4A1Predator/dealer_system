<?php
    class Order extends CI_Model{
        
        var $table = 'order';
        
        function __construct(){
            parent::__construct();
        }
        
        function get_order_by_id($id){
            $this->db->select('*');
            $this->db->from($this->table);
            $this->db->where('order_id', $id);
            $query = $this->db->get();
            
            return $query->row_array();
        }
        
        function get_order($q){
            $this->db->select('*');
            $this->db->from($this->table);
            $this->db->join('order_status', 'order_order_status_id = order_status_id');
            $this->db->where($q);
            $query = $this->db->get();
            
            return $query->row_array();
        }
        
        function list_orders($q=array(), $lim=0, $off=0, $type='arr', $sort='order_id', $op='DESC'){
            $this->db->select('*');
            $this->db->from($this->table);
            $this->db->join('order_status', 'order_status_id = order_order_status_id');
            $this->db->where($q);
            $this->db->order_by($sort);
            $this->db->limit($lim, $off);
            $query = $this->db->get();
        
            return Product::result_as($query, $type);
        }
        
        function list_orders_with_dealer($q=array(), $lim=0, $off=0, $type='arr', $sort='order_id DESC', $op='DESC'){
            $this->db->select('*');
            $this->db->from($this->table);
            $this->db->join('dealer', 'dealer_id = order_dealer_id');
            $this->db->join('order_status', 'order_status_id = order_order_status_id');
            $this->db->where($q);
            $this->db->order_by($sort);
            $this->db->limit($lim, $off);
            $query = $this->db->get();
        
            return Product::result_as($query, $type);
        }
        
        function add($order){
            $res = $this->db->insert($this->table, $order);
            if($res){
                $data['id'] = $this->db->insert_id();
                return $data;
            }
            return NULL;
        }
        
        function get_order_amount($q=array()){
            $this->db->select('order_dealer_id, sum(dealer_order_product.order_product_quantity) as amount');
            $this->db->from('order');
            $this->db->join('order_product', 'order_id = order_product_order_id');
            $this->db->where($q);
            $this->db->where('order_order_status_id', 5);
            $this->db->group_by('order_dealer_id');
            $query = $this->db->get();
            //echo $this->db->last_query()."<br/>";
            return $query->row_array();
        }
        
        function get_order_spent($q=array()){
            $this->db->select('order_dealer_id, sum(order_price) as amount, sum(order_oprice)-sum(order_price) as benefit');
            $this->db->from('order');
            $this->db->where($q);
            $this->db->where('order_order_status_id', 5);
            $this->db->group_by('order_dealer_id');
            $query = $this->db->get();
            
            return $query->row_array();
        }
        
        function get_sale_amount($q=array()){
            $this->db->select('sum(order_price) as amount');
            $this->db->from('order');
            $this->db->where('order_order_status_id >=', 3);
            $this->db->where($q);
            $query = $this->db->get();
            //echo $this->db->last_query()."<br/>";
            return $query->row_array();
        }
        
        function get_num_rows($q=array()){
            $this->db->select('*');
            $this->db->from($this->table);
            $this->db->join('order_status', 'order_status_id = order_order_status_id');
            $this->db->where($q);
            $query = $this->db->get();
            
            return $query->num_rows();
        }
        
        function get_depend_order_amount($q){
            $this->db->select('count(order_id) as amount');
            $this->db->from($this->table);
            $this->db->where($q);
            $this->db->where('order_order_status_id <', 4);
            $query = $this->db->get();
            
            return $query->row_array();
        }
        
        function edit($q, $new_arr){
            $this->db->set($new_arr);
            $this->db->where($q);
            $res = $this->db->update($this->table);
            
            return $res;
        }
        
        function remove($id){
            // remove in order_product table
            $this->Order_product->remove_by_order($id);
            
            $this->db->where('order_id', $id);
            return $res = $this->db->delete($this->table);
        }
        
    }
    