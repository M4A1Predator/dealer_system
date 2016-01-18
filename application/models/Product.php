<?php
    class Product extends CI_Model{
        
        var $table = 'product';
        var $view = 'view_product';
        
        function __construct(){
            parent::__construct();
        }
        
        //get a product by id
        function get_product($id, $type='arr'){
            $this->db->select('*');
            $this->db->where('product_id', $id);
            $query = $this->db->get($this->table);
            
            return Product::row_as($query, $type);
        }
        
        //get product with full attributes
        function get_product_view($q, $type='arr'){
            $this->db->select('*');
            $this->db->from($this->view);
            $this->db->where($q);
            $this->db->join('price', 'price_product_id = product_id');
            $query = $this->db->get();
            
            return Product::row_as($query, $type);
        }
        
        //list product
        function list_products($q=array(), $lim=0, $off=0, $type='arr'){
            $this->db->select('*');
            $this->db->where($q);
            $this->db->order_by('product_id', 'DESC');
            $query = $this->db->get($this->table, $lim, $off);
            
            return Product::result_as($query, $type);
        }
        
        //list product with full attributes
        function list_products_view($q=array(), $lim=0, $off=0, $type='arr'){
            $this->db->select('*');
            $this->db->where($q);
            $query = $this->db->get($this->view, $lim, $off);
            
            return Product::result_as($query, $type);
        }
        
        //list product view with price
        function list_products_view_op($q=array(), $lim=0, $off=0, $type='arr', $order=NULL, $op='ASC'){
            $this->db->select('*');
            $this->db->from($this->view);
            $this->db->join('price', 'price_product_id = product_id');
            $this->db->where($q);
            $this->db->where('product_status_id >=', 1);
            //$this->db->where('product_status_id', 1);
            //$this->db->where_not_in('product_status_id', array(0, 3));
            if($order != NULL){
                $this->db->order_by($order, $op);
            }
            $this->db->limit($lim, $off);
            $query = $this->db->get();
            
            return Product::result_as($query, $type);
        }
        
        function list_products_view_by_filter($q=array(), $filt=array(), $lim=0, $off=0, $type='arr', $order=NULL, $op='ASC'){
            $this->db->select('*');
            $this->db->from($this->view);
            $this->db->join('price', 'price_product_id = product_id');
            $this->db->where($q);
            if(count($filt) > 0){
                if(isset($filt['b_ids'])){
                    $this->db->where_in('product_brand_id', $filt['b_ids']);
                }
                if(isset($filt['c_ids'])){
                    $this->db->where_in('product_category_id', $filt['c_ids']);
                };
            }     
            if($order != NULL){
                $this->db->order_by($order, $op);
            }
            $this->db->limit($lim, $off);
            $query = $this->db->get();
            $data['products'] = Product::result_as($query, $type);
            // get num rows
            $this->db->from($this->view);
            $this->db->join('price', 'price_product_id = product_id');
            $this->db->where($q);
            if(count($filt) > 0){
                if(isset($filt['b_ids'])){
                    $this->db->where_in('product_brand_id', $filt['b_ids']);
                }
                if(isset($filt['c_ids'])){
                    $this->db->where_in('product_category_id', $filt['c_ids']);
                };
            }            
            if($order != NULL){
                $this->db->order_by($order, $op);
            }
            $data['num_rows'] = $this->db->count_all_results();
            return $data;
        }
        
        function list_hot_products($q=array(), $lim=0, $off=0, $type='arr'){
            $this->db->select('*, sum(order_product_quantity) as amount');
            $this->db->from($this->view);
            $this->db->join('order_product', 'order_product_product_id = product_id', 'left');
            $this->db->join('price', 'product_id = price_product_id');
            $this->db->where($q);
            $this->db->where('product_status_id != ', 0);
            $this->db->group_by('product_id');
            $this->db->order_by('amount', 'DESC');
            $this->db->limit($lim, $off);
            $query = $this->db->get();
            
            return Product::result_as($query, $type);
        }
        
        function get_num_rows($q){
            $this->db->where($q);
            $this->db->from($this->table);
            return $this->db->count_all_results();
        }
        
        function add($arr){
            $res = $this->db->insert('product', $arr);
            if($res){
                $data['id'] = $this->db->insert_id();
                return $data;
            }
            return NULL;
        }
        
        function edit($q, $new_data){
            $this->db->set($new_data);
            $this->db->where($q);
            $res = $this->db->update('product');
            //$res = $this->db->affected_rows();
            return $res;
        }
        
        function remove($id){
            $new = array(
                    'product_status_id' => 0
                    );
            $this->db->set($new);
            $this->db->where('product_id', $id);
            $this->db->update($this->table);
            $res = $this->db->affected_rows();
            return $res;
        }
        
        function add_view($id){
            $product = $this->get_product($id);
            $view = $product['product_view'] + 1;
            
            $new_arr = array(
                'product_view' => $view,
            );
            
            $this->db->where('product_id', $id);
            $this->db->update($this->table, $new_arr);
            
        }
        
        //* Static method
        //return result by type
        public static function result_as($obj, $type='arr'){
            if($type == 'arr'){
                return $obj->result_array();
            }
            return $obj->result();
        }
        //return row by type
        public static function row_as($query, $type='arr'){
            if($type == 'arr'){
                return $query->row_array();
            }
            return $query->row();
        }
    }